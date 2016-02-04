<?php

/**
 * Class JoomagREST
 */
class JoomagREST {
    const BASE_URL = "http://www.joomag.com/api/2.0/";

    const CAT_GENERAL = 6;
    const CAT_PRO_SPORTS = 7;
    const CAT_AUTOMOTIVE = 8;
    const CAT_WORLD = 9;
    const CAT_FASHION = 11;
    const CAT_BOATING_AND_AVIATION = 12;
    const CAT_DESIGN = 13;
    const CAT_SCIENCE = 15;
    const CAT_HISTORY = 19;
    const CAT_ADULT = 21;
    const CAT_HUNTING_AND_FISHING = 22;
    const CAT_EDUCATION = 24;
    const CAT_GAMING = 26;
    const CAT_FOOTBALL = 29;
    const CAT_HEALTH_AND_FITNESS = 30;
    const CAT_MUSIC = 36;
    const CAT_POLITICS = 39;
    const CAT_RELIGION_AND_SPIRITUALITY = 40;
    const CAT_LIFESTYLE = 41;
    const CAT_TEEN = 42;
    const CAT_ART = 43;
    const CAT_MOTORCYCLES = 44;
    const CAT_BUSINESS = 47;
    const CAT_CHILDRENS = 48;
    const CAT_PHOTOGRAPHY = 65;
    const CAT_CYCLING = 67;
    const CAT_TRUCKS = 70;
    const CAT_PERSONAL_FINANCE = 82;
    const CAT_WINE_AND_SPIRITS = 88;
    const CAT_FOOD_AND_COOKING = 89;
    const CAT_HOME_DECOR = 90;
    const CAT_LITERARY = 94;
    const CAT_CELEBRITY_AND_GOSSIP = 97;
    const CAT_TELEVISION = 98;
    const CAT_ETHNIC_AND_CULTURE = 99;
    const CAT_CRAFTS = 108;
    const CAT_ARCHITECTURE = 114;
    const CAT_GARDENING = 116;
    const CAT_REAL_ESTATE = 121;
    const CAT_VACATION = 123;
    const CAT_OUTDOOR = 130;
    const CAT_FAMILY_AND_PARENTING = 140;
    const CAT_NATURE = 148;
    const CAT_WINTER_SPORTS = 150;
    const CAT_COLLEGE_SPORTS = 152;
    const CAT_BRIDAL_AND_WEDDINGS = 156;
    const CAT_BEAUTY = 157;
    const CAT_HOCKEY = 174;
    const CAT_GOLF_AND_TENNIS = 184;
    const CAT_HOBBIES = 185;
    const CAT_WEB_AND_COMPUTING = 186;
    const CAT_PETS_AND_ANIMALS = 187;
    const CAT_CARS_SPECIALTY = 188;
    const CAT_OFF_ROAD = 189;
    const CAT_URBAN = 191;
    const CAT_FOOTWEAR = 192;
    const CAT_ACCESSORIES = 193;
    const CAT_JEWELRY = 194;
    const CAT_TRENDS = 195;
    const CAT_ALTERNATIVE = 196;
    const CAT_LOCAL_AND_REGIONAL = 197;
    const CAT_MOVIES = 198;
    const CAT_GAY_AND_LESBIAN = 199;
    const CAT_LUXURY = 200;
    const CAT_SHOPPING = 201;
    const CAT_CAUSES_AND_SOCIAL_INTERESTS = 203;
    const CAT_TRADE = 205;
    const CAT_BOARDS = 206;
    const CAT_OCEAN_SPORTS = 207;
    const CAT_ROMANCE = 210;

    private $apiKey;
    private $secKey;

    /**
     * @param $apiKey string
     * @param $apiSecretKey string
     */
    public function __construct($apiKey, $apiSecretKey) {
        $this->apiKey = $apiKey;
        $this->secKey = $apiSecretKey;
    }

    /**
     * @param string $method HTTP method
     * @param string $url URL where the request should be sent
     * @param array $params list of parameters
     * @param array $files list of files
     * @return array
     */
    public function sendRequest($method, $url, $params = array(), $files = array()) {
        $url = self::BASE_URL . $url;

        $sig = $this->calculateSignature($method, $url, $params);

        $headers = array(
            "key: {$this->apiKey}",
            "sig: $sig"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "joomag PHP api wrapper Mozilla/4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        } else {
            $paramQueryStr = http_build_query($params);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramQueryStr);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $responseArr = json_decode($response, true);
        return $responseArr;
    }

    public function get($url, $params = array()) {
        return $this->sendRequest("GET", $url, $params);
    }

    public function post($url, $params = array()) {
        return $this->sendRequest("POST", $url, $params);
    }

    public function put($url, $params = array()) {
        return $this->sendRequest("PUT", $url, $params);
    }

    public function delete($url, $params = array()) {
        return $this->sendRequest("DELETE", $url, $params);
    }

    private function calculateSignature($method, $url, $params) {
        ksort($params);

        unset($params['pdf']);

        $paramsStr = "";
        foreach($params as $val) {
            $paramsStr .= $val;
        }
        $sig = hash_hmac('sha256', $method . $url . $paramsStr, $this->secKey);
        return $sig;
    }

    // MAGAZINES ///////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @return array
     */
    public function getMagazinesList() {
        $url = "magazines";
        return $this->get($url);
    }

    /**
     * @param $title
     * @param $description
     * @param array $params
     * @return array
     */
    public function createMagazine($title, $description, $params = array()) {
        $url = "magazines";
        $params['title'] = $title;
        $params['description'] = $description;
        return $this->post($url, $params);
    }

    // MAGAZINE ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param $magazineID
     * @param array $params
     * @return array
     */
    public function updateMagazine($magazineID, $params = array()) {
        $url = "magazines/$magazineID";
        return $this->put($url, $params);
    }

    /**
     * @param $magazineID
     * @return array
     */
    public function listIssues($magazineID) {
        $url = "magazines/$magazineID/issues";
        return $this->get($url);
    }

    /**
     * @param $magazineID
     * @return array
     */
    public function getMagazineDetails($magazineID) {
        $url = "magazines/$magazineID";
        return $this->get($url);
    }

    /**
     * @param $magazineID
     * @param $filePath
     * @param $params
     * @return array
     * @throws Exception
     */
    public function createIssueFromPDF($magazineID, $filePath, $params) {
        if (file_exists($filePath)) {
            $url = "magazines/$magazineID";
            $params['pdf'] = new CURLFile($filePath);
            return $this->sendRequest("POST", $url, $params);
        } else {
            throw new Exception('PDF file not found');
        }
    }

    /**
     * @param string $issueTempID
     * @return array
     * @throws Exception
     */
    public function getIssueStatus( $issueTempID ) {
        $url = "issues/$issueTempID/status";
        return $this->get($url);
    }

    /**
     * @param $magazineID - magazine ID
     * @param $confirm1 - should have value of "I do realize I want to delete an entire magazine with all issues"
     * @param $confirm2 - should have value of "I also realize that I will not have it back"
     * @param $confirm3 - should have value of "and I will not contact customer support asking to bring it back"
     * @return array
     */
    public function deleteMagazine($magazineID, $confirm1, $confirm2, $confirm3) {
        $url = "magazines/$magazineID";
        $params = array(
            'confirm' => $confirm1,
            'confirm2' => $confirm2,
            'confirm3' => $confirm3
        );
        return $this->delete($url, $params);
    }

    // ISSUE PUBLISH STATE /////////////////////////////////////////////////////////////////////////////////////////////

    public function getIssuePublishState($issueID) {
        $url = "issues/$issueID/publish-state";
        return $this->get($url);
    }

    public function publishIssue( $issueID, $privacy ) {
        $url = "issues/$issueID/publish-state";

        $params = array(
            'privacy' => $privacy
        );

        return $this->sendRequest("PUT", $url,$params);
    }

    public function unpublishIssue($issueID) {
        $url = "issues/$issueID/publish-state";
        return $this->delete($url);
    }

    // ISSUE ///////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function deleteIssue($issueID) {
        $url = "issues/$issueID";
        return $this->delete($url);
    }

    public function getIssueDetails($issueID) {
        $url = "issues/$issueID";
        return $this->get($url);
    }

    public function updateIssue($issueID, $params) {
        $url = "issues/$issueID";
        return $this->put($url, $params);
    }

    // SUBSCRIBERS /////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getSubscribersList() { return $this->getContactsList(); }
    public function getContactsList() {
        $url = "contacts";
        return $this->get($url);
    }

    public function getSubscriberDetails($contactID) { return $this->getContactDetails($contactID); }
    public function getContactDetails($contactID) {
        $url = "contacts/$contactID";
        return $this->get($url);
    }

    public function updateSubscriber($contactID, $params) { return $this->updateContact($contactID, $params); }
    public function updateContact($contactID, $params) {
        $url = "contacts/$contactID";
        return $this->put($url, $params);
    }

    public function deleteSubscriber($contactID) { return $this->deleteContact($contactID); }
    public function deleteContact($contactID) {
        $url = "contacts/$contactID";
        return $this->delete($url);
    }

    public function createSubscriber($email, $params) { return $this->createContact($email, $params); }
    public function createContact($email, $params) {
        $param['email'] = $email;
        $url = "contacts";
        return $this->post($url, $params);
    }

    public function deliverSubscription($contactID, $magazineID) {
        $url = "contacts/$contactID";
        $params = array(
            'magazine_ID' => $magazineID
        );
        return $this->post($url, $params);
    }

    public function deliverIssue($contactID, $magazineID) {
        $url = "contacts/$contactID";
        $params = array(
            'magazine_ID' => $magazineID
        );
        return $this->post($url, $params);
    }

    public function createToken ( $email, $params ) {
        $url = "contacts/$email/tokens";
        return $this->post($url, $params);
    }

    public function deleteAllTokens ( $email ) {
        $url = "contacts/$email/tokens";
        return $this->delete($url);
    }
}
