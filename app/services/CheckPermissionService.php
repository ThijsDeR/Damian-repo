<?php

namespace App\Services;

use App\Models\UserRole;

class CheckPermissionService {
    public static $SUPER_ADMINISTRATOR = 1;
    public static $ADMINISTRATOR = 2;
    public static $TRUCK_DRIVER = 3;
    public static $SALES = 4;

    public static $ROLES = [1, 2, 3, 4];

    public static function hasRoleOrHigher($user, $role)
    {
        $userRoles = CheckPermissionService::getAllRolesFromUser($user);

        $hasHigherRole = false;
        foreach($userRoles as $userRole) {
            if ($userRole >= $role) $hasHigherRole = true;
        }
        
        return $hasHigherRole;
    }

    public static function hasRole($user, $role, $club_id = null, $team_id = null)
    {
        $userRoles = CheckPermissionService::getAllRolesFromUser($user, $club_id, $team_id);

        return in_array($role, $userRoles);
    }

    public static function hasHigherRole($user, $role) 
    {
        $userRoles = CheckPermissionService::getAllRolesFromUser($user);

        $hasHigherRole = false;
        foreach($userRoles as $userRole) {
            if ($userRole > $role) $hasHigherRole = true;
        }
        
        return $hasHigherRole;
    }


    public static function getAllRolesFromUser($user)
    {
        $userRolesArray = [];

        $userRoles = UserRole::where('user_id', $user['id'])->get();

        foreach($userRoles as $userRole) {
            if ($userRole["super_admin"]) array_push($userRolesArray, CheckPermissionService::$SUPER_ADMINISTRATOR);
            if ($userRole["admin"]) array_push($userRolesArray, CheckPermissionService::$ADMINISTRATOR);
            if ($userRole["truck_driver"]) array_push($userRolesArray, CheckPermissionService::$TRUCK_DRIVER);
            if ($userRole["sales"]) array_push($userRolesArray, CheckPermissionService::$SALES);
        }
        
        return array_unique($userRolesArray);
    }

    public static function getHighestRoleFromUser($user) 
    {
        $userRoles = CheckPermissionService::getAllRolesFromUser($user);
        $highestRole = null;
        foreach($userRoles as $userRole)
        {
            if (!$highestRole) $highestRole = $userRole;
            else if ($highestRole > $userRole) $highestRole = $userRole;
        }   

        return $highestRole;
    }
}