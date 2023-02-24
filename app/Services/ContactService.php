<?php

namespace App\Services;

use Illuminate\Support\Collection;


class ContactService
{
    public static function mapExcellCollectionsByColumnHeadersToArray(Collection $contacts, array $columnHeaders): array
    {
        $contacts = $contacts->all()[0];
        $contacts->shift(); // removed header

        $contacts = $contacts->map(function ($row) use ($columnHeaders) {

            $title = $row[0];
            $first_name = $row[1];
            $last_name = $row[2];
            $mobile_number = $row[3];
            $company_name = $row[4];

            return [
                'title' => ${$columnHeaders['column_header_title']},
                'first_name' => ${$columnHeaders['column_header_first_name']},
                'last_name' => ${$columnHeaders['column_header_last_name']},
                'mobile_number' => ${$columnHeaders['column_header_mobile_number']},
                'company_name' => ${$columnHeaders['column_header_company_name']},
            ];
        });

        return $contacts->all();
    }
}