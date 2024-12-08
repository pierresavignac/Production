<?php
namespace ProgressionWebService;

class TaskMapper {
    public static function mapTaskResponse($rawResponse) {
        if (!isset($rawResponse->records->Record[0])) {
            return null;
        }

        $task = $rawResponse->records->Record[0];
        
        return [
            'code' => $task->Code,
            'summary' => $task->Summary,
            'description' => trim($task->Description),
            'date' => $task->Rv,
            'client' => [
                'name' => $task->ClientRef->Label,
                'address' => [
                    'street' => $task->ClientAddress->Address,
                    'city' => $task->ClientAddress->City,
                    'postal_code' => $task->ClientAddress->PostalCode,
                ],
                'phone' => $task->ClientAddress->Phone,
                'email' => $task->ClientAddress->Email
            ],
            'items' => self::mapItems($task->TaskItemList->TaskItems->Record),
            'totals' => [
                'subtotal' => $task->TaskItemList->SubTotal,
                'taxes' => self::mapTaxes($task->TaskItemList->TaxAmounts->Record),
                'total' => $task->TaskItemList->Total
            ]
        ];
    }

    private static function mapItems($items) {
        $mappedItems = [];
        foreach ($items as $item) {
            if ($item->Price > 0) {
                $mappedItems[] = [
                    'label' => $item->Label,
                    'price' => $item->Price,
                    'quantity' => $item->Quantity,
                    'total' => $item->Total
                ];
            }
        }
        return $mappedItems;
    }

    private static function mapTaxes($taxes) {
        $mappedTaxes = [];
        foreach ($taxes as $tax) {
            $mappedTaxes[$tax->TaxRef->Label] = $tax->Amount;
        }
        return $mappedTaxes;
    }
} 