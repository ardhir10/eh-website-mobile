<?php

namespace App\Http\Controllers;

use App\Models\ApiLogs;
use Illuminate\Http\Request;

class ApiLogsController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            // {
            //     "pH": "7.6661",
            //     "tss": "135.0268",
            //     "nh3n": "2.0832",
            //     "cod": "206.1440",
            //     "debit": "4084.1957",
            //     "totalizer": "1526124",
            //     "datetime": 1737560631,
            //     "token": "wOoFD2OeWwgXAeLgoKalw24rcnpg4u6Y",
            //     "status_send": "success"
            // }

            $prepareData = [
                'ph' => $data['pH'],
                'tss' => $data['tss'],
                'nh3n' => $data['nh3n'],
                'cod' => $data['cod'],
                'debit' => $data['debit'],
                'totalizer' => $data['totalizer'],
                'token' => $data['token'],
                'datetime' => $data['datetime'],
                'datetime_client_formated' => date('Y-m-d H:i:s', $data['datetime']),
                'status_send' => $data['status_send'],
            ];

            ApiLogs::create($prepareData);

            return response()->json([
                'success' => true,
                'message' => 'Data has been successfully recorded',
                'data' => $prepareData
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to record data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getMonitoringData(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'required|date_format:Y-m-d H:i:s',
                'end_date' => 'required|date_format:Y-m-d H:i:s',
                'token' => 'required|string',
                'parameter' => 'sometimes|string|in:ph,tss,nh3n,cod,debit,totalizer'
            ]);

            $query = ApiLogs::where('token', $request->token)
                ->whereBetween('datetime_client_formated', [$request->start_date, $request->end_date])
                ->orderBy('datetime_client_formated', 'asc');

            // If parameter is specified, only return that parameter's data
            if ($request->has('parameter')) {
                $query->select('datetime_client_formated', $request->parameter);
            }

            $data = $query->get();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch monitoring data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
