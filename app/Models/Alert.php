<?php

namespace App\Models;

use Database\Factories\AlertFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model {
	use HasFactory;

	protected $table = 'alert';
	protected $guarded = 'id';

	protected $fillable = [
		'send_date',
		'read_date',
		'matter',
		'sender',
		'receiver',
		'read'
	];

	protected $casts = [
		'read' => 'boolean'
	];

	public $timestamps = false;

	public function sender() {
		return $this -> hasOne('App\Models\Person', 'dni');
	}

	public function receiver() {
		return $this -> hasOne('App\Models\Person', 'dni');
	}

	public static function getSender($person) {
		return Alert::where('sender', '=', $person) -> get();
	}

	public static function getReceiver($person) {
		return Alert::where('receiver', '=', $person) -> get();
	}

	protected static function newFactory(): AlertFactory {
		return AlertFactory::new();
	}
}
