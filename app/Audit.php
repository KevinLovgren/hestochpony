<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    static function audit(string $event, Model $user, array $old_values, array $new_values, $tags = "")
    {
        $auth_user = Auth::user();
        /**
         * Should only include the values that have been changed
         */
        $diffed_old_values = array_diff_assoc($old_values, $new_values);
        $diffed_new_values = array_diff_assoc($new_values, $old_values);

        /**
         * Should exclude all values from the auditExclude array
         */
        $diffed_old_values = array_diff_key($diffed_old_values, array_flip($user->auditExclude ?? []));
        $diffed_new_values = array_diff_key($diffed_new_values, array_flip($user->auditExclude ?? []));

        /**
         * Early return if all changes is to excluded items
         */
        if(count($diffed_new_values) == 0 && count($diffed_old_values) == 0) { return; }

        /**
         * Create audit entry
         */
        $audit = new Audit();

        if (isset($auth_user)) {
            $audit->user_type = get_class($auth_user);
            $audit->user_id = $auth_user->id;
        }

        $audit->event = $event;
        $audit->auditable_type = get_class($user);
        $audit->auditable_id = $user->id;
        $audit->old_values = json_encode($diffed_old_values);
        $audit->new_values = json_encode($diffed_new_values);
        $audit->url = url()->current();
        $audit->ip_address = Audit::get_ip();
        $audit->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $audit->tags = $tags;



        $audit->save();
    }

    private static function get_ip()
    {
        if (!isset($ip_address)) $ip_address = $_SERVER['REMOTE_ADDR'];

        if (isset($_SERVER['HTTP_X_REAL_IP'])) $ip_address = $_SERVER['HTTP_X_REAL_IP'];
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) $ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'];
        if (isset($_SERVER['HTTP_INCAP_CLIENT_IP'])) $ip_address = $_SERVER['HTTP_INCAP_CLIENT_IP'];

        return $ip_address;
    }
}
