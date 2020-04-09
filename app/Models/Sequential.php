<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Sequential extends Model
{

    protected $fillable = [
        'type',
        'value'
    ];



    private $type;

    public $types = [
        'inv-in',
        'inv-o',
        'contract'
    ];

    private $base = "0000";

    public function createCode($type)
    {
        $this->type = $type;

        if (!in_array($this->type ,$this->types)) {
            return false;
        }

        switch ($this->type) {
            case 'inv-in':
                return $this->generateCodeInvIn();
                break;
            case 'inv-o':
                return $this->generateCodeInvOut();
                break;
            case 'contract':
                return $this->generateCodeContract();
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Generate a code for Inv type in
     *
     * @return void
     */
    private function generateCodeInvIn()
    {
        $sequential = $this->getLastSequential();
        dd($sequential);
    }

    /**
     * Generate a code for Inv type out
     *
     * @return void
     */
    private function generateCodeInvOut()
    {
        # code...
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
        $this->saveSequential($currentSequential,$this->type);

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
     * Get Business Name
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
     * @param String $name
     * @return void
     */
    private function saveSequential($sequential,$type)
    {
        $this->create([
            'value' => $sequential,
            'type' => $type
        ]);
    }
}
