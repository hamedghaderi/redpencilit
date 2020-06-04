<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    
    use SoftDeletes;
    
    protected $guarded = [];
    
    protected $dates
        = [
            'delivery_date'
        ];
    
    protected $casts
        = [
            'payed' => 'boolean'
        ];
    
    protected $hidden
        = [
            'transaction_id',
        ];
    
    public function scopeFilterBy($builder, $type)
    {
        if (in_array($type, config('orders-status'))) {
            return $builder->where('status', $type);
        }
        
        return $builder;
    }
    
    /**
     * Each order may have many details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
    
    /**
     * Each order belongs to a service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    /**
     * Each order belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    /**
     * Add a new token to an order.
     *
     * @param $token
     */
    public function addToken($token)
    {
        if ($this->tokenAlreadyExist($token)) {
            abort(500, 'Data is not valid');
        }
        
        $this->token = $token;
        
        $this->save();
    }
    
    /**
     * Check if token already exists.
     *
     * @param $token
     *
     * @return bool
     */
    public function tokenAlreadyExist($token)
    {
        return ! ! $this->where('token', $token)->first();
    }
    
    /**
     * Settle a payed order
     *
     * @param $data
     *
     * @return
     */
    public static function settled($data, $token)
    {
        $order = static::where('token', $token)
                       ->where('payed', false)->firstOrFail();
        
        $order->payed = true;
        $order->transaction_id = $data['transId'];
        $order->card_number = $data['cardNumber'];
        $order->trace_number = $data['traceNumber'];
        $order->save();
        
        return $order->fresh();
    }
    
    /**
     * Change an order status.
     *
     * @param $status
     */
    public function changeStatus($status)
    {
        $this->update([
            'status' => (int) $status
        ]);
    }
}
