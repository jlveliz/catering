<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Sequential extends Model
{

    protected $fillable = [
        'type',
        'value'
    ];


    /**
     * CUSTOM SETTINGS
     */



    private $type;

    public $types = [
        'inv-i',
        'inv-o',
        'contract'
    ];

    private $base = "0000";

    private $initialInv = "IN";

    public function createCode($type)
    {
        $this->type = $type;

        if (!in_array($this->type ,$this->types)) {
            return false;
        }

        switch ($this->type) {
            case 'contract':
                return $this->generateCodeContract();
                break;
            default:
                return $this->generateCodeForInventory();
                break;
        }
    }

    /**
     * Generate a code for Inv type in
     *
     * @return void
     */
    private function generateCodeForInventory()
    {
        $lastSequential = $this->getLastSequential();
        $currentSequential = (int)$lastSequential + 1;
        $sequential = $this->formatSequential($currentSequential);
        //Type inventory
        $typeInventory = $this->type == 'inv-i' ? 'I' : 'O';
        //year format 20 - 21 - 22
        $cYear = date('y');
        //current Month 01-02-03
        $cMonth = date('m');
        //current Day
        $cDay = date('d');


         /**
         * Save Sequential
         */
        $this->saveSequential($currentSequential);

        //Inventory Code
        return $this->initialInv . $typeInventory . $cYear . $cMonth . $cDay . $sequential;
    }


    /**
     * Generate a code for for Contract
     *
     * @return void
     */
    private function generateCodeContract()
    {
        $currentYear = date('Y');
        $lastSequential = $this->getLastSequential();
        $currentSequential = (int)$lastSequential + 1;
        $sequential = $this->formatSequential($currentSequential);
        $business = $this->getBusinessName();

        /**
         * Save Sequential
         */
        $this->saveSequential($currentSequential);

        return $business.'-'.$currentYear.'-'.$sequential;
    }



    /**
     * Functions Helpers
     */

    private function getLastSequential()
    {
        return $this->where('type',$this->type)->first() ?
                    $this->where('type',$this->type)->orderBy('id','desc')->first()->value :
                    0;
    }


    /**
     * Format a sequential
     *
     * @param [int] $sequential
     * @return void
     */
    private function formatSequential($sequential)
    {
        $sequential = strval($sequential);
        return substr_replace($this->base,$sequential,3);

    }

    /**
     * Get the first letter of a Business Name
     *
     * @return String
     */
    private function getBusinessName()
    {
        $business = Setting::where('key','business_name')->where('value','!=','')->first() ?
                        Setting::where('key','business_name')->first()->value :
                        config('app.name');

        $upper = strtoupper($business);
        $stripped = str_replace(" ","",$upper);
        return $stripped[0].$stripped[1].$stripped[2];

    }

    /**
     * Undocumented function
     *
     * @param Int $sequential
     * @return void
     */
    private function saveSequential($sequential)
    {
        $this->create([
            'value' => $sequential,
            'type' => $this->type
        ]);
    }
}
