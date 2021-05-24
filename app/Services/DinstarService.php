<?php

namespace App\Services;

use App\Models\MobileBrand;

class DinstarService
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $data;

    /**
     * The data should contains the following
     *  -- Configuration
     *      -- dinstar_url
     *      -- globe_ports
     *      -- smart_ports
     *      -- receive_ports
     * For Sending
     *  -- Mobile - please format in 639xxxxxxxxx
     *  -- Message
    */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Send SMS to Dinstar
     */
    public function send()
    {
        $mobile = $this->data->mobile;
        
        /**
         * Mobile Number format checking 
         * and replace to the correct format
         */
        $pattern = "/^(09)\\d{9}/i";
        if(preg_match($pattern, $mobile)) {
            $mobile = preg_replace('/^0/i', '63', $mobile);
            info($mobile);
        }
        $pattern = "/^(\+639)\\d{9}/i";
        if(preg_match($pattern, $mobile)) {
            $mobile = preg_replace('/^(\+)/i', '', $mobile);
        }
        $pattern = "/^(639)\\d{9}/i";
        /**
         * Return error if the format is not correct
         */
        if(!preg_match($pattern, $mobile)) {
            return (object) [
                'success' => false,
                'message' => 'Error sending SMS.',
                'body' => 'Invalid Number Format'
            ];
        }

        $param = new \StdClass();
        $param->number = $mobile;
        $params[] = $param;

        if(isset($this->data->port)) {
            $sendPorts = $this->data->port;
        }else {
            /**
            * Retrieve which brand to use
            * Default to SMART if not GLOBE
            */
            $prefix = substr($mobile, 0, 5);
            $mobprefix = MobileBrand::where('prefix', $prefix)->first();
            $brand = $mobprefix->brand;

            if($brand == MobileBrand::GLOBE) {
                $sendPorts = explode(",",$this->data->configuration->globe_ports);
            }else {
                $sendPorts = explode(",",$this->data->configuration->smart_ports);
            }
        }

        $ports[] = (int)array_rand($sendPorts, 1);

        $message = new \StdClass();
        $message->text = $this->data->message;
        $message->param = $params;
        $message->port = $ports;
        $url = $this->data->configuration->dinstar_url . "/api/send_sms";
        try {
            ini_set('max_execution_time', 100);
            $client = new \GuzzleHttp\Client();
            $authorization = "Basic " . $this->data->configuration->token;

            $response = $client->post(
                $url,
                [
                    'headers' => [
                        'Authorization' => $authorization,
                        'Content-Type' => "application/json",
                    ],
                    'body' => json_encode($message),
                ]
            );
            return (object) [
                'success' => true,
                'message' => 'Success sending SMS.',
                'body' => $response->getBody()
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return (object) [
                'success' => false,
                'message' => 'Error sending SMS.',
                'body' => $e->getMessage()
            ];
        }
    }

    /**
     * Retrieve the unread sms in Dinstar
     */
    public function get()
    {

 
        $url = $this->data->configuration->dinstar_url . "/api/query_incoming_sms?flag=unread".
        "port=[" . $this->data->configuration->get_port . "]";
        
        try {
            ini_set('max_execution_time', 100);
            $client = new \GuzzleHttp\Client();
            $authorization = "Basic " . $this->data->configuration->token;
            $result = $client->get(
                $url,
                [
                    'headers' => [
                        'Authorization' => $authorization,
                        'Content-Type' => "application/json",
                    ],
                ]
            );
            $response = json_decode($result->getBody());
            $smses = $response->sms;

            return (object) [
                'success' => true,
                'message' => 'Success retrieving SMS.',
                'body' => $smses
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return (object) [
                'success' => false,
                'message' => 'Error retrieving SMS.',
                'body' => $e->getMessage()
            ];
        }
    }
}
