<?php

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

if (!function_exists('uploadImage')) {
    function uploadImage($file = null, $path = '', $path_info = '')
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($path, $fileName);
        return $fileName;
    }
}

if (!function_exists('multipleUploadImage')) {
    function multipleUploadImage($files = null, $path = '', $path_info = '')
    {
        $filenames = [];
        foreach ($files as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $filenames[] = $fileName;
        }
        return $filenames;
    }
}

if (!function_exists('print_die')) {
    function print_die($arr = array())
    {
        echo "<pre>";
        print_r($arr);
        echo "<pre/>";
        die;
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

