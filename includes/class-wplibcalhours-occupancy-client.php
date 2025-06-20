<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WpLibCalHours
 * @subpackage WpLibCalHours/includes
 */

/**
 * Spacy occupancy client.
 *
 * This class defines all code necessary to retrieve hours data from the Spacy API.
 * @package    WpLibCalHours
 * @subpackage WpLibCalHours/includes
 * @author     Dean Farrell
 */
class WpLibCalHours_Occupancy_Client {

    /**
     * The ID of this plugin.
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private string $plugin_name;

    /**
     * The version of this plugin.
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private string $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct(string $plugin_name, string $version) {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    /**
     * Caches occupancy data and passes it back to the requesting page
     * @return array
     */
    public function getOccupancyData(): array
    {
        $events_key = 'occupancy_data';
        $data = get_transient($events_key);

        if (!$data) {
            $transient_timeout = 10; // tem minutes
            $data = $this->fetchOccupancyFromAPI();
            set_transient($events_key, $data, $transient_timeout);
        }

        return json_decode($data, true);
    }

    /**
     * Fetches occupancy-data from the Spacy API.
     *
     * @return bool|string
     */
    protected function fetchOccupancyFromAPI(): bool|string
    {
        $ch = curl_init('https://atka.lib.unc.edu/spacy/api/all');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if (curl_error($ch)) {
            error_log('Unable to fetch occupancy from the Spacy API: ' . curl_error($ch));
            return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
        }

        return $result;
    }

    /**
     * Map LibCal locations to Spacy api and return the requested library's Spacy api code
     * @param $location_name
     * @param $occupancy_data
     * @return array
     */
    public function getLocationOccupancy($location_name, $occupancy_data): array
    {
        $mappings = [
            'Art Library' => 'Art Library',
            'Davis Library' => 'Davis Library',
            'Health Sciences Library' => 'Health Sciences Library',
            'Information & Library Science Library' => 'SILS Library',
            'Stone Center Library' => 'Stone Center Library',
            'Undergraduate Library' => 'Undergraduate Library',
            'Wilson Special Collections Library' => 'Wilson Library'
        ];

        $normalized_location = $mappings[$location_name];
        $matching_location = array_filter($occupancy_data, function ($location) use ($normalized_location) {
            return $location['name'] == $normalized_location;
        });

        if (count($matching_location) != 1) {
            return [];
        }

        $location_info = array_values($matching_location)[0];
        if ($location_info['status'] == 'closed') {
            return [];
        }

        return $location_info;
    }
}
