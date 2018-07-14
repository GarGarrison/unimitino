<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // protected $guarded = ['id',];
    protected $fillable = [
        "uid",
        "name",
        "city",
        "company",
        "post_index",
        "address",
        "phone",
        "qiwi_phone",
        "bank_name",
        "bank_account",
        "inn",
        "email",
        "type",
        "money",
        "gid",
        "countorder",
        "countdone",
        "price",
        "payment",
        "payment_status",
        "delivery_type",
        "transport_company",
        "delivery_status",
        "status",
        "takeplace",
        "comment",
        "storage_user",
        "billid",
    ];

}
