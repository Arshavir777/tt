<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (Property::count()) {
            $this->command->info('Properties already seeded');
            return;
        }

        $limit = 10;
        $filePath = database_path('seeds/property-data.csv');

        // Check if the file exists
        if (!file_exists($filePath)) {
            $this->command->error('CSV file not found for seed');
            return;
        }

        $header = null;
        $data = [];
        $counter = 0;

        // Read file content chunk by chunk
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $counter++;
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }

                if ($counter >= $limit) {
                    $insertData = array_map(function ($data) {
                        return [
                            'name' => $data['Name'],
                            'price' => $data['Price'],
                            'bedrooms' => $data['Bedrooms'],
                            'bathrooms' => $data['Bathrooms'],
                            'storeys' => $data['Storeys'],
                            'garages' => $data['Garages']
                        ];
                    }, $data);

                    Property::insert($insertData);

                    $data = [];
                    $counter = 0;
                }
            }
            fclose($handle);
        }
    }
}
