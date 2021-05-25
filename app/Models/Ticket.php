<?php

/**
 * Ticket Model
 * Created by : Jovic
 * 2021-04-19
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;

class Ticket extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'mobile',
        'port',
        'message',
        'status',
        'assigned_to',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    protected $dateFormat = 'Y-m-d';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    const PER_PAGE = 15;
    const UNASSIGNED = 0;
    const ASSIGNED = 1;
    const PENDING = 2;
    const CLOSED = 3;

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
   
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to','id' );
    }
    public function conversation()
    {
        return $this->hasMany(TicketConversation::class, 'ticket_id');
    }

    public function scopeOpen($query)
    {
        return $query->where('status', '<', self::CLOSED);
    }
    public function scopeClosed($query)
    {
        return $query->where('status', self::CLOSED);
    }
    public static function ticketReports($projectId,$year,$month)
    {
        if($year == "" || isset($year) == false){
            $where = "";
        }else{
            $where = " WHERE  
                        ReportYear = " .$year. "
                        AND 
                        ReportMonth = " .$month . " ";
        }
        $projectparameter = "";
        if($projectId>0){
            $projectparameter = "`project_id` = ".$projectId. " AND";
        }
        $query = "
                    SELECT 
                        TMP.ReportYear, 
                        TMP.ReportMonth,  
                        SUM(TMP.Unassigned) AS Unassigned, 
                        SUM(TMP.Assigned) AS Assigned, 
                        SUM(TMP.Pending) AS Pending, 
                        SUM(TMP.Closed) AS Closed 
                    FROM (
                        SELECT YEAR(`created_at`) AS ReportYear, MONTH(`created_at`) AS ReportMonth, count(`id`) as Unassigned, 0 AS Assigned, 0 AS Pending, 0 AS Closed FROM `tickets` WHERE ". $projectparameter ." `status` = 0 GROUP BY YEAR(`created_at`) , MONTH(`created_at`) UNION ALL
                        SELECT YEAR(`created_at`) AS ReportYear, MONTH(`created_at`) AS ReportMonth, 0 AS Unassigned, count(`id`) AS  Assigned, 0 AS Pending, 0 AS Closed FROM `tickets` WHERE ". $projectparameter ." `status` = 1 GROUP BY YEAR(`created_at`) , MONTH(`created_at`) UNION ALL
                        SELECT YEAR(`created_at`) AS ReportYear, MONTH(`created_at`) AS ReportMonth, 0 as Unassigned, 0 AS Assigned, count(`id`) as Pending, 0 AS Closed FROM `tickets` WHERE ". $projectparameter ." `status` = 2 GROUP BY YEAR(`created_at`) , MONTH(`created_at`) UNION ALL
                        SELECT YEAR(`created_at`) AS ReportYear, MONTH(`created_at`) AS ReportMonth, 0 as Unassigned, 0 AS Assigned, 0 AS Pending, count(`id`) AS Closed FROM `tickets` WHERE ". $projectparameter ." `status` = 3 GROUP BY YEAR(`created_at`) , MONTH(`created_at`)
                    ) 
                    TMP
                     " . $where . "
                    GROUP BY 
                        ReportYear, 
                        ReportMonth 
                    ORDER BY 
                        ReportYear DESC,
                        ReportMonth DESC
                ";
        
                
        $results = DB::select($query);
        return $results;
    }

    public static function ticketYearMonth()
    {   
        return Ticket::get( DB::raw(" MAX(YEAR(`created_at`)) AS year,  MONTH(`created_at`) AS month") );
    }

    public static function ticketYears()
    {
        return Ticket::groupBy(DB::raw("  YEAR(`created_at`) "))->get( DB::raw("  YEAR(`created_at`) AS year  ") );
    }
}
