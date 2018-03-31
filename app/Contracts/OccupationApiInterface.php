<?php

namespace App\Contracts;

use Illuminate\Http\Request;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
interface OccupationApiInterface {
    public function getOccupations(Request $request);
    public function getResponsibilities($occupation_id);
    public function storeOccupation(Request $request);
    public function storeResponsibility(Request $request);
    public function updateOccupation(Request $request, $occupation_id);
    public function updateResponsibility(Request $request, $responsibility_id);
}