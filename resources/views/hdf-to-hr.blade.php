<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>51Talk Events</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
        width: 100% !important;
        height: 100% !important;
        padding: 10px !important;
        margin: 0 !important;
        background-color: #e9ecef;
    }
    .content {
        background-color: #e9ecef;
        padding: 40px;
    }

    .logo {
        display: block;
        width: 30%;
        height: auto;
        border: 0;
    }
    .details {
        background-color: #ffffff;
        margin: 10px 0px 0px 0px;
        padding: 15px;
    }

    .ref-code-text {
        margin-top: 10px;
        margin-bottom: 0px;
        text-align: center;
    }
    .ref-code {
        color: #000;
        background-color: #ffe800;
        padding: 10px 20px;
        text-align: center;
        width: 35%;
        max-width: 45%;
        margin: 0px auto;
    }
    .footnote {
        padding: 10px;
        background-color: #e9ecef;
        font-size: 0.8em;
    }
  </style>
</head>
<body>
    <div class="content">
        <img src="{{ $data->logo }}" alt="Logo" class="logo">
        <div class="details">
            <h2>Health Declaration Form</h2>
            <p>
                Hi!
            <p>
            <p>
                There is a new request to visit the office. <br>
                The requester has {{ $data->data->passedText }} the requirements.<br>
                See details below.<br>
            <hr>
            
            
            <h3>EMPLOYEE-VISITOR'S DECLARATION FORM</h3>
            <b>Date:</b> {{ date('Y-m-d', strtotime($data->data->date)) }}<br>
            <b>Full Name:</b> {{ $data->data->fullname }}<br>
            <b>Email:</b> {{ $data->data->email }}<br>
            <b>Mobile Number:</b> {{ $data->data->mobile_number }}<br>
            <b>Age:</b> {{ $data->data->age }}<br>
            <b>Gender:</b> {{ $data->data->gender }}<br>
            <b>Employee Number:</b> {{ $data->data->employee_number }}<br>
            <b>Status:</b> {{ $data->data->visitor_type }}<br>
            <b>Nature of Visit:</b> {{ $data->data->nature_of_visit }}<br>
            <b>Temperature:</b> {{ $data->data->temperature }}<br>
            <b>Department:</b> {{ $data->data->department }}<br>
            <b>Site:</b> {{ $data->data->site }}<br>
            <b>Home Address:</b> {{ $data->data->home_address }}<br>
            {{-- Multiple --}}
            <h3>PLEASE ANSWER THE FOLLOWING HEALTH-RELATED QUESTIONS</h3>
            <b>1. Are you experiencing any of the following? Please check..:</b> {{ str_replace(["[", "\"", "]"], "", $data->data->health_check) }}<br>
            <b>2. Have you been in contact or stayed in a closed environment with a person potentially exposed to COVID-19 and/or confirmed COVID-19 person, or anyone related or had contact with a confirmed COVID-19 patient? (Friend, Relative, Neighbor, Colleague) :</b> {{ $data->data->contact_covid == 1 ? 'Yes' : 'No' }}<br>
            <b>3. Did you have any contact with someone with fever, cough, colds, sore throat in the past 3 weeks? :</b> {{ $data->data->contact_flu == 1 ? 'Yes' : 'No' }}<br>
            <b>4. Have you travelled outside the Philippines in the past 14 days? :</b> {{ $data->data->travelled_outside_ph == 1 ? 'Yes' : 'No' }}<br>
            <b>5. Have you ever travelled to any area in your Region aside from your home in the last 14 days? :</b> {{ $data->data->travelled_ncr == 1 ? 'Yes' : 'No' }}<br>
            <b>6. List the places you've been to yesterday. (For Contact Tracing):</b> {{ $data->data->places_yesterday }}<br>
            <h3>ADDITIONAL SAFETY AND HEALTH CHECKLIST</h3>
            <b>1. How many are you in the house? :</b> {{ $data->data->household_headcount }}<br>
            <b>2. Is there anyone currently ill in the household? :</b> {{ $data->data->ill_in_household == 1 ? 'Yes' : 'No' }}<br>
            <b>If Yes, What are the symptoms? :</b> {{ $data->data->ill_in_household_symptoms }}<br>
            <b>3 How long has the symptoms existed? :</b> {{ $data->data->ill_in_household_how_long }}<br>
            <b>4. Has a medical Worker/Doctor examined the patient? :</b> {{ $data->data->ill_in_household_is_examined == 1 ? 'Yes' : 'No' }}<br>
            <b>5. Can you give an overview of the examination result? :</b> {{ $data->data->ill_in_household_exam_result }}<br>
            <b>6. Do you manifest any of the following symptoms. Please Check. :</b> {{ str_replace(["[", "\"", "]"], "", $data->data->symptoms_check) }}<br>
            <b>6a. Do you have any pre-existing health conditions related to list below that may put you at high risk of COVID-19? :</b> {{ $data->data->pre_existing_conditions == 1 ? 'Yes' : 'No' }}<br>
            <b>If yes, select one? :</b> {{ $data->data->pre_existing_conditions_yes }}<br>
            <b>7. Have you attended a mass gathering/meeting in the last 14 days?:</b> {{ $data->data->mass_gathering == 1 ? 'Yes' : 'No' }}<br>
            <b>If yes, where and when? :</b> {{ $data->data->mass_gathering_yes }}<br>
            <b>8. Did anyone from your household attended a mass gathering/meeting in the last 14 days? :</b> {{ $data->data->household_mass_gathering == 1 ? 'Yes' : 'No' }}<br>
            <b>If yes, where and when? :</b> {{ $data->data->household_mass_gathering_yes }}<br>
            <hr>
            <p class="footnote">
                51Talk Email Notification. Please do not reply
            </p>
        </div>
    </div>
</body>
</html>
