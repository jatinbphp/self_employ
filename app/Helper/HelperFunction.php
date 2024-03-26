<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ChatMessage;
use App\Models\ChatUser;
use App\Models\LoginDetailActivity;
use App\Models\Post;
use App\Models\AcceptOffer;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('my_posts')) {
    function my_posts()
    {
        try {
            $my_posts = Post::get()->pluck('user_id');
            return $my_posts;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('my_projects')) {
    function my_projects()
    {
        try {
            $my_projects = AcceptOffer::get()->pluck('user_id');
            return $my_projects;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('generate_token')) {
    function generate_token($length = 10)
    {
        try {
            $new_token = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
            if (strlen($new_token) < $length) {
                return generate_token();
            }

            return $new_token;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('generate_otp')) {
    function generate_otp(Int $length = 6)
    {
        try {
            $new_otp_code = rand(000000, 999999);
            if (strlen($new_otp_code) < $length) {
                return generate_otp();
            }

            return $new_otp_code;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('generate_password')) {
    function generateStrongPassword(Int $length = 10)
    {
        try {
            $password = rand(00000000, 99999999);
            return $password;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($file = null, $path = '')
    {
        try {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $fileName);
            return $fileName;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('multipleUploadImage')) {
    function multipleUploadImage($files = null, $path = '')
    {
        try {
            $filenames = [];
            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $filenames[] = $fileName;
            }
            return $filenames;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('daysInMonth')) {
    function daysInMonth()
    {
        try {
            return Carbon::now()->daysInMonth;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('ToTimeString')) {
    function ToTimeString()
    {
        try {
            return Carbon::now()->ToTimeString();
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('getPrevious12Months')) {
    function getPrevious12Months()
    {
        try {
            $start = new DateTime;
            $start->setDate($start->format('Y'), $start->format('n'), 1); // Normalize the day to 1
            $start->setTime(0, 0, 0); // Normalize time to midnight
            $start->sub(new DateInterval('P12M'));
            $interval = new DateInterval('P1M');
            $recurrences = 12;
            foreach (new DatePeriod($start, $interval, $recurrences, true) as $date) {
                $months_array[] =  $date->format('Y-m'); // attempting to make it more clear to read here
            }
            return $months_array;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('ToDateString')) {
    function ToDateString()
    {
        try {
            return Carbon::now()->ToDateString();
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('getMonths')) {
    function getMonths()
    {
        try {
            $data = array();
            for ($i = 0; $i <= 11; $i++) {
                $month = Carbon::today()->startOfYear()->addMonth($i);
                $year = Carbon::today()->year;
                array_push($data, array(
                    'id' => $month->format('m'),
                    'month' => $month->shortMonthName,
                    'monthName' => $month->monthName,
                    'year' => $year,
                ));
            }
            return $data;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('getNextYears')) {
    function getNextYears()
    {
        try {
            $data = array();
            for ($i = 0; $i <= 4; $i++) {
                $year = Carbon::now()->addYear($i)->format('Y');
                array_push($data, array(
                    'year' => $year,
                ));
            }
            return $data;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('maskEmail')) {
    function mask_email($email, $char_shown_front = 2, $char_shown_back = 3)
    {
        try {
            $mail_parts = explode('@', $email);
            $username = $mail_parts[0];
            $url = $mail_parts[1];
            $len = strlen($username);

            if ($len < $char_shown_front or $len < $char_shown_back) {
                return implode('@', $mail_parts);
            }

            //Logic: show asterisk in middle, but also show the last character before @
            $mail_parts[0] = substr($username, 0, $char_shown_front)
                . str_repeat('*', $len - $char_shown_front - $char_shown_back)
                . substr($username, $len - $char_shown_back, $char_shown_back);

            return implode('@', $mail_parts);
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('maskEmail1')) {
    function mask_email2($email, $show = 3)
    {
        $arr = explode('@', $email);
        return substr($arr[0], 0, $show) . str_repeat('*', strlen($arr[0]) - $show) . $arr[1];
    }
}

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
            $areaCode = substr($phoneNumber, -10, 3);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);

            $phoneNumber = '+' . $countryCode . ' (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
        } else if (strlen($phoneNumber) == 10) {
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);

            $phoneNumber = '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
        } else if (strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);

            $phoneNumber = $nextThree . '-' . $lastFour;
        }

        return $phoneNumber;
    }
}

if (!function_exists('pp')) {
    function pp($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die('call');
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format)
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('slug')) {
    function slug(string $data)
    {
        return Str::slug($data);
    }
}

if (!function_exists('uploadSingleImage')) {
    function uploadSingleImage($file = null, $path = null)
    {
        try {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $filename);

            return $filename;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('uploadMultipleImages')) {
    function uploadMultipleImages($files = null, $path = null)
    {
        try {
            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $filename);
                $images[] = $filename;
            }
            return $images;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('calculateAge')) {
    function calculateAge($dob)
    {
        try {
            return Carbon::parse($dob)->diff(Carbon::now())->format('%y Years, %m Months and %d Days');
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('strtotimeDate')) {
    function strtotimeDate($data)
    {
        try {
            return strtotime(Carbon::parse($data));
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('strtoupper')) {
    function uppercase($data)
    {
        try {
            return strtoupper($data);
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('urlQuery')) {
    function urlQuery($to, array $params = [], array $additional = [])
    {
        try {
            return Str::finish(url($to, $additional), '?') . Arr::query($params);
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('show_route')) {
    function show_route($model, $resource = null)
    {
        $resource = $resource ?? plural_from_model($model);

        return route("{$resource}.show", $model);
    }
}

if (!function_exists('plural_from_model')) {
    function plural_from_model($model)
    {
        $plural = Str::plural(class_basename($model));

        return Str::kebab($plural);
    }
}

if (!function_exists('schedule')) {
    function schedule($opening_time = null, $closing_time = null, $interval = null)
    {
        $opening_time = is_null($opening_time) ? '0:00' : $opening_time;
        $closing_time = is_null($closing_time) ? '23:59' : $closing_time;
        $interval = is_null($interval) ? '60' : $interval;
        $intervals = CarbonInterval::minutes($interval)->toPeriod($opening_time, $closing_time);

        $allTimes = [];
        foreach ($intervals as $date) {
            array_push($allTimes, $date->format('h:i A'));
        }
        return $allTimes;
    }
}

if (!function_exists('getTimeSlot')) {
    function getTimeSlot($interval, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i = 0;
        $time = [];
        while (strtotime($startTime) <= strtotime($endTime)) {
            $start = $startTime;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            $startTime = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            $i++;
            if (strtotime($startTime) <= strtotime($endTime)) {
                $time[$i]['slot_start_time'] = $start;
                $time[$i]['slot_end_time'] = $end;
            }
        }
        return $time;
    }
}

if (!function_exists('get_setting_data')) {
    function get_setting_data($meta_title = "", $column = "", $condition = "")
    {
        $value = "";
        if ($column == '') {
            $column = 'content';
        }
        if ($meta_title != "") {
            $get_setting = Setting::where('meta_title', $meta_title);
            if ($condition != "") {
                $get_setting->where('child_meta_title', $condition);
            }
            $get_setting = $get_setting->orderby('id', 'desc')->first();
            if ($get_setting) {
                if ($get_setting[$column] != "Empty") {
                    $value =  $get_setting[$column];
                }
            }
        }
        return $value;
    }
}


if (!function_exists('get_table_data')) {
    function get_table_data($table_name = "", $column = "", $id = '')
    {
        $value = "";
        if ($table_name != "") {
            $get_data = DB::table($table_name);
            if ($column != "") {
                if ($id != "") {
                    $get_data = $get_data->where('id', $id);
                }
                $get_data =  $get_data->first();

                if ($get_data) {
                    if (array_key_exists($column, (array)$get_data)) {
                        $value = $get_data->$column;
                    }
                }
            }
        }
        return $value;
    }
}







/**
 *
 * Jquery Chat System
 *
 */

if (!function_exists('fetch_user_last_activity')) {
    function fetch_user_last_activity($user_id)
    {
        try {
            $user_last_activity = LoginDetailActivity::where("user_id", $user_id)->orderBy('last_activity', "DESC")->first();
            return $user_last_activity->last_activity;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('fetch_user_chat_history')) {
    function fetch_user_chat_history($from_user_id, $to_user_id)
    {
        //dd([$from_user_id, $to_user_id]);
        try {
            $user_chat_history = ChatMessage::where(["from_user_id" => $from_user_id, "to_user_id" => $to_user_id])
                ->orWhere(["from_user_id" => $to_user_id, "to_user_id" => $from_user_id])
                ->orderBy('created_at', "ASC")->get();
            $html = '<ul class="list-unstyled">';

            foreach ($user_chat_history as $message) {
                $user_name = '';
                $dynamic_background = '';
                $chat_message = '';
                if ($message["from_user_id"] == $from_user_id && $message['to_user_id'] == $to_user_id) {
                    if ($message["status"] == '2') {
                        $chat_message = '<em>This message has been removed</em>';
                        $user_name = '<b class="text-success">You</b>';
                    } else {
                        $chat_message =  empty($message['chat_message']) ? "<a href='" . $message["chat_image"] . "' download><img src='" . $message["chat_image"] . "' width='80px'/></a>" : $message['chat_message'];
                        //$chat_message = $message['chat_message'];
                        $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="' . $message['id'] . '">x</button>&nbsp;<b class="text-success">You</b>';
                    }
                    $dynamic_background = 'background-color:#ffe6e6;';
                } else {
                    if ($message["status"] == '2') {
                        $chat_message = '<em>This message has been removed</em>';
                    } else {
                        //$chat_message = $message["chat_message"];
                        $chat_message =  empty($message['chat_message']) ? "<a href='" . $message["chat_image"] . "' download><img src='" . $message["chat_image"] . "' width='80px'/></a>" : $message['chat_message'];
                    }
                    $user_name = '<b class="text-danger">' . get_user_name($message['from_user_id']) . '</b>';
                    $dynamic_background = 'background-color:#ffffe6;';
                }

                $html .= '<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
                                <p>' . $user_name . ' - ' . $chat_message . '
                                    <div align="right"> - <small><em>' . $message['created_at'] . '</em></small> </div>
                                </p>
                            </li>';
            }
            $html .= '</ul>';
            // ChatMessage::where(["from_user_id" => $from_user_id, "to_user_id" => $to_user_id])
            //     ->orWhere(["from_user_id" => $to_user_id, "to_user_id" => $from_user_id, "status" => 1])
            //     ->update([
            //         'status' => 0
            //     ]);
            ChatMessage::where(["from_user_id" => $to_user_id, "to_user_id" => $from_user_id, "status" => 1])->update([
                'status' => 0
            ]);

            return $html;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('get_user_name')) {
    function get_user_name($user_id)
    {
        try {
            $user = User::where('id', $user_id)->first();
            return $user->name;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('count_unseen_message')) {
    function count_unseen_message($from_user_id, $to_user_id)
    {
        try {
            $chat_count = ChatMessage::where("from_user_id", $from_user_id)->where("to_user_id", $to_user_id)->where('status', 1)->count();
            $result = '';
            if ($chat_count > 0) {
                $result = '<span class="badge bg-success">' . $chat_count . '</span>';
            }
            return $result;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('fetch_is_type_status')) {
    function fetch_is_type_status($user_id)
    {
        try {
            $user_activity = LoginDetailActivity::where("user_id", $user_id)->orderBy('last_activity', "DESC")->first();
            $result = '';
            foreach ($user_activity as $activity) {
                if ($activity->is_type == 'yes') {
                    $result = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
                }
            }
            return $result;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('fetch_group_chat_history')) {
    function fetch_group_chat_history($to_user_id = 0)
    {
        try {
            $all_messages = ChatMessage::where("to_user_id", $to_user_id)->orderBy('created_at', "DESC")->get();
            $result = '';
            $html = '<ul class="list-unstyled">';
            foreach ($all_messages as $message) {
                $user_name = '';
                $dynamic_background = '';
                $chat_message = '';
                if ($message["from_user_id"] == Auth::user()->id) {
                    if ($message["status"] == '2') {
                        $chat_message = '<em>This message has been removed</em>';
                        $user_name = '<b class="text-success">You</b>';
                    } else {
                        $chat_message = $message["chat_message"];
                        $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="' . $message['id'] . '">x</button>&nbsp;<b class="text-success">You</b>';
                    }
                    $dynamic_background = 'background-color:#ffe6e6;';
                } else {
                    if ($message["status"] == '2') {
                        $chat_message = '<em>This message has been removed</em>';
                    } else {
                        $chat_message = $message["chat_message"];
                    }
                    $user_name = '<b class="text-danger">' . get_user_name($message['from_user_id']) . '</b>';
                    $dynamic_background = 'background-color:#ffffe6;';
                }
                $html .= '<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '"><p>' . $user_name . ' - ' . $chat_message . ' <div align="right"> - <small><em>' . $message['created_at'] . '</em></small></div></p></li>';
            }
            $html .= '</ul>';
            return $result;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('fetch_user')) {
    function fetch_user()
    {
        try {
            $user_id = Auth::user()->id;
            $users = User::whereRelation('chat_messages_send', function ($cms) use ($user_id) {
                $cms->where('from_user_id', $user_id);
            })->orWHereRelation('chat_messages_receive', function ($cmr) use ($user_id) {
                $cmr->where('to_user_id', $user_id);
            })->get();

            $html = '<table class="table table-bordered table-striped"><thead><th width="60%">Username</td><th width="20%">Status</td><th width="20%">Action</td></head><tbody>';
            foreach ($users as $row) {
                $current_timestamp = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . '- 10 second'));
                $user_last_activity = fetch_user_last_activity($row['id']);
                $status = ($user_last_activity > $current_timestamp) ? '<span class="badge bg-success">Online</span>' : '<span class="badge bg-danger">Offline</span>';
                $html .= '<tr><td>' . $row['name'] . ' ' . count_unseen_message($row['id'], Auth::user()->id) . ' ' . fetch_is_type_status($row['id']) . '</td><td>' . $status . '</td><td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="' . $row['id'] . '" data-tousername="' . $row['name'] . '">Chat</button></td></tr>';
            }
            $html .= '</tbody></table>';
            return $html;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('get_card_number')) {
    function get_card_number($creditCardNumber)
    {
        $length = strlen($creditCardNumber);
        $firstFour = substr($creditCardNumber, 0, 4);
        $lastFour = substr($creditCardNumber, -4);
        $numStars = $length - 8;
        $stars = str_repeat('*', $numStars);
        $maskedCreditCardNumber = $firstFour . $stars . $lastFour;
        // Output: 1234********3456
        return $maskedCreditCardNumber;
    }
}
