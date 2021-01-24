<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session, Response, Redirect;
use \Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Support\Facades\DB;
use App\Model\MeetingTbl;
use Auth;

class ZoomController extends Controller
{
    private $zoom_api_key = '5xdjKWxjTuyRmr5OpXhDDg';
    private $zoom_api_secret = 'F8CSDU7zkccN6PVnA4VhLy0UrrXTlV3mJ6XA';

    protected function sendRequest($data)
    {
        $request_url = 'https://api.zoom.us/v2/users/me/meetings';
        $headers = array(
            "authorization: Bearer " . $this->generateJWTKey(),
            'content-type: application/json'
        );
        $postFields = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$response) {
            return $err;
        }
        return json_decode($response);
    }

    //function to generate JWT
    private function generateJWTKey()
    {
        $key = $this->zoom_api_key;
        $secret = $this->zoom_api_secret;
        $token = array(
            "iss" => $key,
            "exp" => time() + 3600 //60 seconds as suggested
        );
        //	$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IlI1OWZNMEViUXFPcWNrU0c4dzR2MmciLCJleHAiOjE1OTA1MTM4NDUsImlhdCI6MTU5MDUwODQ0N30.4ch2OZoFM_vZFdqhoMzJX8r8GPYjKlOkV_vUa7LprFc";
        return JWT::encode($token, $secret);
    }

    public function createAMeeting($data = array())
    {
        $post_time  = $data['start_date'];
        $start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));
        $createAMeetingArray = array();
        if (!empty($data['alternative_host_ids'])) {
            if (count($data['alternative_host_ids']) > 1) {
                $alternative_host_ids = implode(",", $data['alternative_host_ids']);
            } else {
                $alternative_host_ids = $data['alternative_host_ids'][0];
            }
        }
        $createAMeetingArray['topic']      = $data['meetingTopic'];
        $createAMeetingArray['agenda']     = !empty($data['agenda']) ? $data['agenda'] : "";
        $createAMeetingArray['type']       = !empty($data['type']) ? $data['type'] : 2; //Scheduled
        $createAMeetingArray['start_time'] = $start_time;
        $createAMeetingArray['timezone']   = $data['timezone'];
        $createAMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
        $createAMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;
        $createAMeetingArray['settings']   = array(
            'join_before_host'  => !empty($data['join_before_host']) ? true : false,
            'host_video'        => !empty($data['option_host_video']) ? true : false,
            'participant_video' => !empty($data['option_participants_video']) ? true : false,
            'mute_upon_entry'   => !empty($data['option_mute_participants']) ? true : false,
            'enforce_login'     => !empty($data['option_enforce_login']) ? true : false,
            'auto_recording'    => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
            'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        );
        return $this->sendRequest($createAMeetingArray);
    }

    public function add(Request $request)
    {
        // $zoom_meeting = new Zoom_Api();
        // dd($request->all());

        if (!empty($request->all())) {

            $get_res = $this->createAMeeting(
                array(
                    'meetingTopic' => $request->topic ? $request->topic : 'Example Test Meeting',
                    'agenda' => $request->agenda ? $request->agenda : 'Example Test Meeting',
                    'password' => $request->password ? $request->password : '12345',
                    'duration' => $request->duration ? $request->duration : 10,
                    'start_date' => $request->start_date ? date("Y-m-d h:i:s", strtotime($request->start_date)) : date("Y-m-d h:i:s", strtotime('today')),
                    'timezone' => 'Asia/Calcutta'
                )
            );
            /* echo '<pre>';
            var_dump($get_res);
            die; */
            if (!empty($get_res)) {
                $meetingTbl = new MeetingTbl();
                $meetingTbl->user_id = Auth::id();
                $meetingTbl->meeting_id = $get_res->id;
                $meetingTbl->host_id = $get_res->host_id;
                $meetingTbl->host_email = $get_res->host_email;
                $meetingTbl->topic = $get_res->topic;
                $meetingTbl->type = $get_res->type;
                $meetingTbl->chstatus = $get_res->status;
                $meetingTbl->start_time = $get_res->start_time;
                $meetingTbl->duration = $get_res->duration;
                $meetingTbl->timezone = $get_res->timezone;
                $meetingTbl->created_date = $get_res->created_at;
                $meetingTbl->start_url = $get_res->start_url;
                $meetingTbl->join_url = $get_res->join_url;
                $meetingTbl->password = $get_res->password;
                $result = $meetingTbl->save();
                if ($result) {
                    return redirect('create/meeting')->with('success', 'created successfully');
                } else {
                    return redirect('create/meeting')->with('error', 'failed to create');
                }
            }
        }
    }
    public function index()
    {
        $meeting_tbl = MeetingTbl::get();
        return view('meeting_index', compact('meeting_tbl'));
    }
    public function remove($meeting_id = null)
    {
        echo $meeting_id;
        echo '<br>' . $this->generateJWTKey();
        $res = $this->deleteRequest($meeting_id);

        echo 'hh<br><pre>';
        print_r($res);

        // return view('meeting_index', compact('meeting_tbl'));
    }
    protected function deleteRequest($meeting_id)
    {
        $request_url = 'https://api.zoom.us/v2/meetings/{$meeting_id}';
        $headers = array(
            "Authorization: Bearer" . $this->generateJWTKey(),
        );
        // $postFields = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$response) {
            return $err;
        }
        return json_decode($response, true);
    }
    public function startMeeting($meeting_id)
    {
        $role = getRoleID(Auth::id());
        /* $data = DB::table('meeting_tbl')
            ->select('users.name', 'users.email', 'meeting_tbl.meeting_id', 'meeting_tbl.id', 'meeting_tbl.topic', 'meeting_tbl.password')
            ->leftJoin('users', 'meeting_tbl.user_id', '=', 'users.id')
            ->where('users.id', Auth::id())
            ->get();
        dd($data); */
        if ($role == 1) {
            return view('startMeeting', compact('meeting_id'));
        } elseif ($role == 2) {

            return view('joinMeeting', compact('meeting_id'));
        }
    }
    public function joinMeeting()
    {
        $meeting_tbl = MeetingTbl::orderBy('id', 'desc')->get();
        // dd($meeting_tbl);
        return view('meeting_join', compact('meeting_tbl'));
    }
}