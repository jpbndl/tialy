<?php

namespace App\Repository\Result;

class ResultMessage {
    protected $noRecordsFoundMessage = ['success' => 0, 'message' => 'No Record(s) found'];

    public function result($result, $message = '', $data ='') {
        if ($result) {
            return response()->json(['status' => 1, 'message' => $message, 'data'=> $data]);
        } else{
            return response()->json(['status' => 0, 'message' => $message ?? 'Error encoutered while performing action', 'data'=> $data]);
        }
    }

    protected function success($data, $message = null, $code = 200)
	{
		return response()->json([
			'status'=> 'Success', 
			'message' => $message, 
			'data' => $data
		], $code);
	}

	protected function error($message = null, $code)
	{
		return response()->json([
			'status'=>'Error',
			'message' => $message,
			'data' => null
		], $code);
	}

    public function noRecordsFound() {
        return $this->noRecordsFoundMessage;
    }
}

?>