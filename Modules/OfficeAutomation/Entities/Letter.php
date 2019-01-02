<?php

namespace Modules\OfficeAutomation\Entities;

use Modules\Org\Entities\Department;
use Modules\Org\Entities\Office;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\CypherHelper;
class Letter extends Model
{
	protected $table = "officeautomation-letters";
    protected $fillable = ["title","body","tags","category","owner_id","to","cc","status"];


    protected $casts = [
        'tags' => 'array',
        'to' => 'array',
        'cc' => 'array',
    ];

    public function owner(){
    	return $this->belongsTo('Modules\Org\Entities\Office','owner_id');
    }


    public function getRecipietentsAttribute(){
    	$c = Collect([]);
    	foreach ($this->to as $v) {
    		$c->push(Office::find($v));
    	}
    	return $c;
    }

    public function getHashedIdAttribute(){
    	return CypherHelper::cypher("".$this->id);
        // $a2 = CypherHelper::decypher($a1);
    }
}
