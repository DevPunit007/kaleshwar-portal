//User Phone Type
@switch($number->type_of_phone) @case(1)Private @break @case(2)Office @break @case(3)Mobile @break @case(4)Fax @break @case(5)Other @endswitch

// User Role
@switch($user->rule_id) @case(1)Visitor @break @case(2)Student @break @case(3)Teacher @break @case(4)Superadmin @break @case(5)Dev_User @endswitch

