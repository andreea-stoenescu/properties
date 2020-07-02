<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;
use App\Models;

class DownloadProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download all the properties from the API, ignoring the ones that are blocked for API updates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $towns = self::build_towns();
        $more_pages = true;
        $page = 0;
        do {
            $page++;
            $response = Http::get(env('MTC_PROPERTY_API_ROOT') . "/api/properties?api_key=" . env('MTC_PROPERTY_API_KEY') . "&page[size]=100&page[number]=$page")->json();
            echo ("\nPAGE = $page \n");
            foreach ($response['data'] as $key => $item) {
                echo (".");
                $item = (object) $item;
                $existing_property = Models\Property::where('uuid', $item->uuid)->first();
                if ($existing_property && $existing_property->block_api_update) continue;
                // dd($item);
                //this is messy and not the most efficient way of doing it, but I don't have time to optimise it
                $country = Models\Country::where('name', $item->country)->first();
                if ($country) {
                    $country->load('counties.towns');
                    $county = $country->counties->where('name', $item->county)->first();
                    if ($county) {
                        $town = $county->towns->where('name', $item->town)->first();
                        if (!$town) {
                            $town = Models\Town::create([
                                'county_id' => $county->id,
                                'name' => $item->town
                            ]);
                        }
                    } else {
                        $county = Models\County::create([
                            'country_id' => $country->id,
                            'name' => $item->county
                        ]);
                        $town = Models\Town::create([
                            'county_id' => $county->id,
                            'name' => $item->town
                        ]);
                    }
                } else {
                    $country = Models\Country::create(['name' => $item->country]);
                    $county = Models\County::create([
                        'country_id' => $country->id,
                        'name' => $item->county
                    ]);
                    $town = Models\Town::create([
                        'county_id' => $county->id,
                        'name' => $item->town
                    ]);
                }
                $property_type = Models\PropertyType::find($item->property_type_id);
                if (!$property_type) {
                    $property_type = Models\PropertyType::create([
                        'id' => $item->property_type_id,
                        'title' => $item->property_type['title'],
                        'description' => $item->property_type['description']
                    ]);
                }
                $listing_type = Models\ListingType::where('name', $item->type)->first();
                if (!$listing_type) {
                    $listing_type = Models\ListingType::create(['name' => $item->type]);
                }
                $property_data = [
                    'uuid' => $item->uuid,
                    'property_type_id' => $property_type->id,
                    'town_id' => $town->id,
                    'description' => $item->description,
                    'address' => $item->address,
                    'image_full' => $item->image_full,
                    'image_thumbnail' => $item->image_thumbnail,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'num_bedrooms' => $item->num_bedrooms,
                    'num_bathrooms' => $item->num_bathrooms,
                    'price' => $item->price,
                    'listing_type_id' => $listing_type->id
                ];
                if ($existing_property) {
                    $existing_property->update($property_data);
                } else {
                    Models\Property::create($property_data);
                }
            }

            $more_pages = ($page < $response['last_page']);
        } while ($more_pages);
    }

    static function build_towns()
    {
        $countries = \App\Models\Country::all()->load('counties.towns');

        foreach ($countries as $country) {
            foreach ($country->counties as $county) {
                foreach ($county->towns as $town) {
                    $array[$country->name][$county->name][$town->name] = $town->id;
                }
            }
        }

        return $array;
    }

    static function get_property_types()
    {
        foreach (\App\Models\PropertyType::all() as $type) {
            $array[$type->name] = $type->id;
        }

        return $array;
    }

    static function get_listing_types()
    {
        foreach (\App\Models\ListingType::all() as $type) {
            $array[$type->name] = $type->id;
        }

        return $array;
    }
}
