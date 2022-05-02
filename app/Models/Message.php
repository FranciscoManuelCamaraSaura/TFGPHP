<?php

namespace App\Models;

use Database\Factories\MessageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {
	use HasFactory;
	
	protected $table = 'message';
	protected $guarded = 'id';

	protected $fillable = [
		'date',
		'matter',
		'text',
		'sender',
		'receiver',
		'previous_message',
		'read',
		'reply'
	];

	protected $casts = [
		'read' => 'boolean',
		'reply' => 'boolean'
	];

	public $timestamps = false;

	public function sender() {
		return $this -> hasOne('App\Models\Person', 'dni');
	}

	public function receiver() {
		return $this -> hasOne('App\Models\Person', 'dni');
	}

	public static function getSender($person) {
		return Message::where('sender', '=', $person) -> get();
	}

	public static function getReceiver($person) {
		return Message::where('receiver', '=', $person) -> get();
	}

	protected static function newFactory(): MessageFactory {
		return MessageFactory::new();
	}
}
