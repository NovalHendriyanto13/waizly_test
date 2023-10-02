<?php
namespace App\Http\Controllers\Basics;

use Illuminate\Http\Request;
use App\Http\Controllers\AppController;

class BasicController extends AppController {
    public function getBasic(Request $request) {
        try {
            $case = $request->id;
            $data = $request->data;
            $responseType = $request->response ?? "string";

            switch ($case) {
                case 1:
                    $res = $this->case1($data);
                    if ($responseType == "string") {
                        return implode(" ", [$res['min'], $res['max']]);
                    } else {
                        return $this->successResponse($res);
                    }
                    break;
                case 2:
                    $res = $this->case2($data);
                    if ($responseType == "string") {
                        return implode("\n ", [
                            number_format($res['positives'], 5),
                            number_format($res['negatives'], 5), 
                            number_format($res['zero'], 5)
                        ]);
                    } else {
                        return $this->successResponse($res);
                    }
                    break;
                case 3:
                    $date = !empty($data) ? $data : 'now';
                    $res = date("H:i:s", strtotime($date));
                    if ($responseType == "string") {
                        return $res;
                    } else {
                        return $this->successResponse([$res]);
                    }
                    break;
                default:
                    throw new \Exeption('Please Provide the basic Number');
                    break;
            }
        } catch (\Exception $e) {
            return $this->error404($e->getMessage());
        }
    }

    private function case1(Array $data) {
        array_multisort($data);
        $minArray = $maxArray = $data;
        
        array_shift($maxArray);
        array_pop($minArray);
        
        return ([
            'max' => array_sum($maxArray),
            'min' => array_sum($minArray),
        ]);
    }

    private function case2(Array $data) {
        $count = count($data);
        $negativeCount = 0;
        $positiveCount = 0;
        $zeroCount = 0;

        foreach($data as $item) {
            $valid = preg_match('(-?\d+(?:\.\d+)?+)', $item);
            if ($valid == 1) {
                if ( $item > 0) {
                    $positiveCount++;
                } elseif( $item < 0) {
                    $negativeCount++;
                } else {
                    $zeroCount++;
                }
            }
        }
        return ([
            'positives' => !is_infinite($positiveCount/$count) ? $positiveCount/$count : 0,
            'negatives' => !is_infinite($negativeCount/$count) ? $negativeCount/$count : 0,
            'zero' => !is_infinite($zeroCount/$count) ? $zeroCount/$count : 0,
        ]);
    }


}