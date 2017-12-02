<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class melcloud extends eqLogic
{
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */

    public static function SetPower($option, $mylogical)
    {

        log::add('melcloud', 'debug', 'SetPower ' . $option);

        $montoken = config::byKey('MyToken', 'melcloud', '');

        if ($montoken != '') {

            $devideid = $mylogical->getConfiguration('deviceid');
            $buildid = $mylogical->getConfiguration('buildid');

            $request = new com_http('https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/Get?id=' . $devideid . '&buildingID=' . $buildid);
            $request->setHeader(array('X-MitsContextKey: ' . $montoken));
            $json = $request->exec(30, 2);
            $device = json_decode($json, true);

            $device['Power'] = $option;
            $device['EffectiveFlags'] = '1';
            $device['HasPendingCommand'] = 'true';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/SetAta");
            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-MitsContextKey: ' . $montoken,
                'content-type: application/json'
            ));

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($device));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($server_output, true);
            self::nextCommunication($json,$mylogical,true, $option);

        }

    }

    public static function SetFan($option, $mylogical)
    {
        log::add('melcloud', 'debug', 'SetFan '. $option);
        $montoken = config::byKey('MyToken', 'melcloud', '');
        if ($montoken != '') {
            $montoken = config::byKey('MyToken', 'melcloud', '');
            $devideid = $mylogical->getConfiguration('deviceid');
            $buildid = $mylogical->getConfiguration('buildid');
            $request = new com_http('https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/Get?id=' . $devideid . '&buildingID=' . $buildid);
            $request->setHeader(array('X-MitsContextKey: ' . $montoken));
            $json = $request->exec(30, 2);
            $device = json_decode($json, true);
            $device['SetFanSpeed'] = $option;
            $device['EffectiveFlags'] = '8';
            $device['HasPendingCommand'] = 'true';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/SetAta");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-MitsContextKey: ' . $montoken,
                'content-type: application/json'
            ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($device));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($server_output, true);
            self::nextCommunication($json,$mylogical);
        }
    }

    public static function SetTemp($newtemp, $mylogical)
    {
        log::add('melcloud', 'debug', 'SetTemp ' . $newtemp);
        $montoken = config::byKey('MyToken', 'melcloud', '');
        if ($montoken != '') {
            $devideid = $mylogical->getConfiguration('deviceid');
            $buildid = $mylogical->getConfiguration('buildid');
            $request = new com_http('https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/Get?id=' . $devideid . '&buildingID=' . $buildid);
            $request->setHeader(array('X-MitsContextKey: ' . $montoken));
            $json = $request->exec(30, 2);
            $device = json_decode($json, true);
            $device['SetTemperature'] = $newtemp;
            $device['EffectiveFlags'] = '4';
            $device['HasPendingCommand'] = 'true';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/SetAta");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-MitsContextKey: ' . $montoken,
                'content-type: application/json'
            ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($device));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($server_output, true);
            self::nextCommunication($json,$mylogical);

        }
    }


    public static function SetMode($newmode, $mylogical)
    {
        log::add('melcloud', 'debug', 'SetMode ' . $newmode);
        $montoken = config::byKey('MyToken', 'melcloud', '');
        if ($montoken != '') {
            $devideid = $mylogical->getConfiguration('deviceid');
            $buildid = $mylogical->getConfiguration('buildid');
            $request = new com_http('https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/Get?id=' . $devideid . '&buildingID=' . $buildid);
            $request->setHeader(array('X-MitsContextKey: ' . $montoken));
            $json = $request->exec(30, 2);
            $device = json_decode($json, true);
            // Mode value : 1 warm, 2 dry, 3 cool, 7 vent, 8 auto
            $device['OperationMode'] = $newmode;
            $device['EffectiveFlags'] = '6';
            $device['HasPendingCommand'] = 'true';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/SetAta");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-MitsContextKey: ' . $montoken,
                'content-type: application/json'
            ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($device));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($server_output, true);
            self::nextCommunication($json,$mylogical,false,$newmode);
        }
    }

    private static function nextCommunication($json,$mylogical,$power=false,$option=null) {
        foreach ($mylogical->getCmd() as $cmd) {
            if ('NextCommunication' == $cmd->getLogicalId()) {
                $cmd->setCollectDate('');
                $time = strtotime($json['NextCommunication'] . " + 1 hours"); // Add 1 hour
                $time = date('G:i:s', $time); // Back to string
                $cmd->event($time);
            } else if ($power &&'Power' == $cmd->getLogicalId()) {
                $cmd->setCollectDate('');
                $cmd->event($option);
            } else if ('OperationMode' == $cmd->getLogicalId()) {
                $cmd->setCollectDate('');
                $cmd->event($option);
            }
        }
    }


    public static function gettoken()
    {
        $myemail = config::byKey('MyEmail', 'melcloud');
        $monpass = config::byKey('MyPassword', 'melcloud');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://app.melcloud.com/Mitsubishi.Wifi.Client/Login/ClientLogin");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "Email=" . $myemail . "&Password=" . $monpass . "&Language=7&AppVersion=1.10.1.0&Persist=true&CaptchaChallenge=null&CaptchaChallenge=null");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($server_output, true);
        if ($json['ErrorId'] == null) {
            log::add('melcloud', 'debug', 'Login ok ');
            config::save("MyToken", $json['LoginData']['ContextKey'], 'melcloud');
        } else {
            log::add('melcloud', 'debug', 'Login ou mot de passe Melcloud incorrecte.');
            config::save("MyToken", $json['ErrorId'], 'melcloud');
        }
    }


    public static function pull()
    {
        $montoken = config::byKey('MyToken', 'melcloud', '');
        if ($montoken != '') {
            log::add('melcloud', 'debug', 'pull 5 minutes mytoken =' . $montoken);
            //$request = new com_http('https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/Get?id='.$devideid.'&buildingID='.$buildid);
            $request = new com_http('https://app.melcloud.com/Mitsubishi.Wifi.Client/User/ListDevices');
            $request->setHeader(array('X-MitsContextKey: ' . $montoken));
            $json = $request->exec(30, 2);
            $values = json_decode($json, true);
            foreach ($values as $maison) {
                log::add('melcloud', 'debug', 'Maison ' . $maison['Name']);
                for ($i = 0; $i < count($maison['Structure']['Devices']); $i++) {
                    $device = $maison['Structure']['Devices'][$i];
                    self::pullCommande($device);
                }
                // FLOORS
                for ($a = 0; $a < count($maison['Structure']['Floors']); $a++) {
                    log::add('melcloud', 'debug', 'FLOORS ' . $a);
                    // AREAS IN FLOORS
                    for ($i = 0; $i < count($maison['Structure']['Floors'][$a]['Areas']); $i++) {
                        for ($d = 0; $d < count($maison['Structure']['Floors'][$a]['Areas'][$i]['Devices']); $d++) {
                            $device = $maison['Structure']['Floors'][$a]['Areas'][$i]['Devices'][$d];
                            self::pullCommande($device);
                        }
                    }
                    // FLOORS
                    for ($i = 0; $i < count($maison['Structure']['Floors'][$a]['Devices']); $i++) {
                        $device = $maison['Structure']['Floors'][$a]['Devices'][$i];
                        self::pullCommande($device);
                    }
                }
                // AREAS
                for ($a = 0; $a < count($maison['Structure']['Areas']); $a++) {
                    log::add('melcloud', 'debug', 'AREAS ' . $a);
                    for ($i = 0; $i < count($maison['Structure']['Areas'][$a]['Devices']); $i++) {
                        log::add('melcloud', 'info', 'machine AREAS ' . $i);
                        $device = $maison['Structure']['Areas'][$a]['Devices'][$i];
                        self::pullCommande($device);
                    }
                }
            }
        }
    }

    private static function pullCommande($device) {
        log::add('melcloud', 'debug', 'pull : ' . $device['DeviceName']);
        if ($device['DeviceID'] == '') return;
        log::add('melcloud', 'info', $device['DeviceID'] . ' ' . $device['DeviceName']);
        foreach (eqLogic::byType('melcloud', true) as $mylogical) {
            if ($mylogical->getConfiguration('namemachine') == $device['DeviceName']) {
                log::add('melcloud', 'debug', 'setdevice ' . $device['Device']['DeviceID']);
                $mylogical->setConfiguration('deviceid', $device['Device']['DeviceID']);
                $mylogical->setConfiguration('buildid', $device['BuildingID']);
                $mylogical->save();
                foreach ($mylogical->getCmd() as $cmd) {
                    //il faut exclure le on/off
                    switch ($cmd->getLogicalId()) {
                        case 'On':
                        case 'Off':
                        case 'refresh':
                        case 'CurrentWeather':
                            log::add('melcloud', 'debug', 'log ' . $cmd->getLogicalId() . ' : On ne traite pas cette commande');
                            break;
                        case 'OperationModeValue':
                        case 'SetTemperatureValue':
                            var $operation = $cmd->getLogicalId().substr_replace("Value","");
                            log::add('melcloud', 'debug', 'log de  ' . $cmd->getLogicalId() . ' ' . $device['Device'][$operation]);
                            $cmd->setCollectDate('');
                            $cmd->event($device['Device'][$operation]);
                            $cmd->save();
                            break;
                        case 'FanSpeed':
                            log::add('melcloud', 'debug', 'log pour le FanSpeed ' . $cmd->getLogicalId() . ' ' . $device['Device'][$cmd->getLogicalId()]);
                            $cmd->setConfiguration('maxValue', $device['Device']['NumberOfFanSpeeds']);
                            //on break pas exprès pour le default!
                        default:
                            log::add('melcloud', 'debug', 'log ' . $cmd->getLogicalId() . ' ' . $device['Device'][$cmd->getLogicalId()]);
                            if ('LastTimeStamp' == $cmd->getLogicalId()) {
                                $cmd->event(str_replace('T', ' ', $device['Device'][$cmd->getLogicalId()]));
                            } else {
                                $cmd->setCollectDate('');
                                $cmd->event($device['Device'][$cmd->getLogicalId()]);
                            }
                            $cmd->save();
                            break;
                    }
                }
                try {
                    self::obtenirInfo($mylogical);
                } catch (Exception $exception) {
                    log::add('melcloud', 'error', 'oops : ' . $exception);
                }
                $mylogical->Refresh();
                $mylogical->toHtml('dashboard');
                $mylogical->refreshWidget();
            }
        }
    }

    public static function obtenirInfo($mylogical)
    {
        log::add('melcloud', 'debug', 'Obtenir Info pour la machine:  ' . $mylogical->getConfiguration('namemachine'));
        $montoken = config::byKey('MyToken', 'melcloud', '');
        if ($montoken != '') {
            $devideid = $mylogical->getConfiguration('deviceid');
            $buildid = $mylogical->getConfiguration('buildid');
            $req = new com_http('https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/Get?id=' . $devideid . '&buildingID=' . $buildid);
            $req->setHeader(array('X-MitsContextKey: ' . $montoken));
            $json = $req->exec(30, 2);
            $device = json_decode($json, true);
            log::add('melcloud', 'debug', 'Retour des informations de obtenirInfo ' . print_r($device,true));
            if(isset($device['WeatherObservations'])) {
                $cmdCurrent = $mylogical->getCmd(null, 'CurrentWeather');
                if(is_object($cmdCurrent)) {
                    log::add('melcloud', 'debug', 'WeatherObservations all = ' . json_encode($device['WeatherObservations'][0]));
                    $cmdCurrent->event(json_encode($device['WeatherObservations'][0]));
                }
            }
        }
        $mylogical->Refresh();
    }

    //Fonction exécutée automatiquement toutes les minutes par Jeedom
    public static function cron(){}

    //Fonction exécutée automatiquement toutes les heures par Jeedom
    public static function cronHourly(){}


    // Fonction exécutée automatiquement tous les jours par Jeedom
    public static function cronDayly(){}


    /*     * *********************Méthodes d'instance************************* */

    public function preInsert(){}

    public function postInsert() {}

    public function preSave(){}

    public function postSave(){
        //TODO Faire les order!

        if ($this->getConfiguration('deviceid') == '') {
            self::pull();
            if ($this->getConfiguration('deviceid') == '') return;
        }

        $onoff_state = $this->getCmd(null, 'Power');
        if (!is_object($onoff_state)) {
            $onoff_state = new melcloudCmd();
            $onoff_state->setLogicalId('Power');
            $onoff_state->setIsVisible(0);
            $onoff_state->setName(__('Power', __FILE__));
        }
        $onoff_state->setType('info');
        $onoff_state->setSubType('binary');
        $onoff_state->setEqLogic_id($this->getId());
        $onoff_state->save();


        $on = $this->getCmd(null, 'On');
        if (!is_object($on)) {
            $on = new melcloudCmd();
            $on->setName('On');
            $on->setLogicalId('On');
            $on->setEqLogic_id($this->getId());
            $on->setType('action');
            $on->setSubType('other');
            $on->setTemplate('dashboard', 'OnOffLight');
            $on->setTemplate('mobile', 'ToggleSwitch_IMG');
            $on->setIsHistorized(0);
            $on->setIsVisible(1);
            $on->setDisplay('generic_type', 'ENERGY_ON');
            $on->setConfiguration('updateCmdId', $onoff_state->getEqLogic_id());
            $on->setConfiguration('updateCmdToValue', 1);
            $on->setValue($onoff_state->getId());
            $on->save();
        }

        $off = $this->getCmd(null, 'Off');
        if (!is_object($off)) {
            $off = new melcloudCmd();
            $off->setName('Off');
            $off->setLogicalId('Off');
            $off->setEqLogic_id($this->getId());
            $off->setType('action');
            $off->setSubType('other');
            $off->setTemplate('dashboard', 'OnOffLight');
            $off->setTemplate('mobile', 'ToggleSwitch_IMG');
            $off->setIsHistorized(0);
            $off->setIsVisible(1);
            $off->setDisplay('generic_type', 'ENERGY_OFF');
            $off->setConfiguration('updateCmdId', $onoff_state->getEqLogic_id());
            $off->setConfiguration('updateCmdToValue', 0);
            $off->setValue($onoff_state->getId());
            $off->save();
        }

        $mode_value = $this->getCmd(null, 'OperationModeValue');
        if (!is_object($mode_value)) {
            $mode_value = new melcloudCmd();
            $mode_value->setName('Valeur de Mode');
            $mode_value->setEqLogic_id($this->getId());
            $mode_value->setLogicalId('OperationModeValue');
            $mode_value->setType('info');
            $mode_value->setSubType('numeric');
            $mode_value->setIsHistorized(0);
            $mode_value->setIsVisible(0);
            $mode_value->save();
        }

        $mode = $this->getCmd(null, 'OperationMode');
        if (!is_object($mode)) {
            $mode = new melcloudCmd();
            $mode->setName('Mode');
            $mode->setEqLogic_id($this->getId());
            $mode->setLogicalId('OperationMode');
            $mode->setType('action');
            $mode->setSubType('message');
            $mode->setTemplate('dashboard', 'ModePAC');
            $mode->setTemplate('mobile', 'ModePAC');
            //$mode->setConfiguration('listValue', '1|Chaud;2|Seche;3|Rafraichir;7|Ventilation;8|Auto');
            //$mode->setDisplay('slider_placeholder', 'Chaud : 1 Seche : 2 Rafraichir : 3 Ventilation : 7 Auto :');
            $mode->setIsHistorized(0);
            $mode->setIsVisible(1);
            $mode->setValue($mode_value->getId());
            $mode->save();
        }

        $consigne_value = $this->getCmd(null, 'SetTemperatureValue');
        if (!is_object($consigne_value)) {
            $consigne_value = new melcloudCmd();
            $consigne_value->setName('Valeur de Consigne');
            $consigne_value->setEqLogic_id($this->getId());
            $consigne_value->setLogicalId('SetTemperatureValue');
            $consigne_value->setType('info');
            $consigne_value->setSubType('numeric');
            $consigne_value->setIsHistorized(0);
            $consigne_value->setIsVisible(0);
            $consigne_value->save();
        }


        $consigne = $this->getCmd(null, 'SetTemperature');
        if (!is_object($consigne)) {
            $consigne = new melcloudCmd();
            $consigne->setName('Consigne');
            $consigne->setEqLogic_id($this->getId());
            $consigne->setLogicalId('SetTemperature');
            $consigne->setType('action');
            $consigne->setSubType('slider');
            $consigne->setTemplate('dashboard', 'consigneTemp');
            $consigne->setIsHistorized(0);
            $consigne->setUnite('°C');
            $consigne->setIsVisible(1);
            $consigne->setDisplay('slider_placeholder', 'Temperature en °c ex');
            $consigne->setConfiguration('maxValue', 30);
            $consigne->setConfiguration('minValue', 10);
            $consigne->setValue($consigne_value->getId());
            $consigne->save();
        }

        $ventilation = $this->getCmd(null, 'FanSpeed');
        if (!is_object($ventilation)) {
            $ventilation = new melcloudCmd();
            $ventilation->setName('Ventilation');
            $ventilation->setEqLogic_id($this->getId());
            $ventilation->setLogicalId('FanSpeed');
            $ventilation->setType('action');
            $ventilation->setSubType('slider');
            $ventilation->setIsHistorized(0);
            //$ventilation->setConfiguration('listValue','0|Automatique;1|Vitesse 1;2|Vitesse 2;3|Vitesse 3;4|Vitesse 4;5|Vitesse 5');
            //$ventilation->setDisplay('slider_placeholder', '0 = automatique, 1 a 5 manuel');
            $ventilation->setTemplate('dashboard', 'button');
            $ventilation->setIsVisible(0);
            $ventilation->setConfiguration('maxValue', 5);
            $ventilation->setConfiguration('minValue', 0);
            $ventilation->save();
        }

        $RoomTemperature = $this->getCmd(null, 'RoomTemperature');
        if (!is_object($RoomTemperature)) {
            $RoomTemperature = new melcloudCmd();
            $RoomTemperature->setName('Température');
            $RoomTemperature->setEqLogic_id($this->getId());
            $RoomTemperature->setLogicalId('RoomTemperature');
            $RoomTemperature->setType('info');
            $RoomTemperature->setSubType('numeric');
            $RoomTemperature->setTemplate('dashboard', 'TempImg');
            $RoomTemperature->setTemplate('mobile', 'tempIMG');
            $RoomTemperature->setIsHistorized(0);
            $RoomTemperature->setIsVisible(1);
            $RoomTemperature->setUnite('°C');
            $RoomTemperature->setValue($this->getId());
            $RoomTemperature->save();
            $RoomTemperature->event(0);
        }

        $actualFanSpeed = $this->getCmd(null, 'ActualFanSpeed');
        if (!is_object($actualFanSpeed)) {
            $actualFanSpeed = new melcloudCmd();
            $actualFanSpeed->setName('Vitesse');
            $actualFanSpeed->setEqLogic_id($this->getId());
            $actualFanSpeed->setLogicalId('ActualFanSpeed');
            $actualFanSpeed->setType('info');
            $actualFanSpeed->setSubType('numeric');
            $actualFanSpeed->setIsHistorized(0);
            $actualFanSpeed->setTemplate('dashboard', 'tile');
            $actualFanSpeed->setIsVisible(1);
            $actualFanSpeed->save();
            $actualFanSpeed->setValue(0);
            $actualFanSpeed->event(0);
        }

        $currentWeather = $this->getCmd(null, 'CurrentWeather');
        if (!is_object($currentWeather)) {
            $currentWeather = new melcloudCmd();
            $currentWeather->setName(__('Temps actuel', __FILE__));
            $currentWeather->setEqLogic_id($this->getId());
            $currentWeather->setLogicalId('CurrentWeather');
            $currentWeather->setType('info');
            $currentWeather->setSubType('string');
            $currentWeather->setConfiguration('category', 'actual');
            $currentWeather->setIsHistorized(0);
            $currentWeather->setDisplay('generic_type', 'WEATHER_TYPE');
            $currentWeather->setIsVisible(1);
            $currentWeather->setValue(0);
            $currentWeather->setTemplate('dashboard', 'CurrentWeather');
            $currentWeather->setTemplate('mobile', 'CurrentWeather');
            $currentWeather->save();
        }

        $refresh = $this->getCmd(null, 'refresh');
        if (!is_object($refresh)) {
            $refresh = new melcloudCmd();
            $refresh->setLogicalId('refresh');
            $refresh->setIsVisible(1);
            $refresh->setName('Rafraichir');
            $refresh->setEqLogic_id($this->getId());
            $refresh->setType('action');
            $refresh->setSubType('other');
            $refresh->save();
        }
    }

    public function preUpdate(){}

    public function postUpdate(){}

    public function preRemove(){}

    public function postRemove(){}


    /*public function toHtml($_version = 'dashboard') {
        $replace = $this->preToHtml($_version);
        if (!is_array($replace)) {
            return $replace;
        }
        $version = jeedom::versionAlias($_version);

        $replace['#info#'] = '';
        foreach ($this->getCmd('info') as $cmd) {
            $replace['#info#'] .= $cmd->toHtml($_version, '', null);
        }
        $replace['#action#'] = '';
        foreach ($this->getCmd('action') as $cmd) {
            if ($cmd->getLogicalId() == 'refresh') {
                continue;
            }
            $replace['#action#'] .= $cmd->toHtml($_version, '', null);
        }
        $refresh = $this->getCmd(null, 'refresh');
        if (is_object($refresh)) {
            $replace['#refresh_id#'] = $refresh->getId();
        }
        return $this->postToHtml($_version, template_replace($replace, getTemplate('core', $version, 'chauffage', 'melcloud')));

    }*/

    /*     * **********************Getteur Setteur*************************** */
}

class melcloudCmd extends cmd
{
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */

    public function execute($_options = array())
    {
        log::add('melcloud', 'debug', 'Va executer la commande : '.$this->logicalId);
        if ('SetTemperature' ==  $this->logicalId) {
            if (isset($_options['slider']) && isset($_options['auto']) == false) {
                melcloud::SetTemp($_options['slider'], $this->getEqLogic());
            }
        }
        if ('On' == $this->logicalId) {
            log::add('melcloud', 'debug', 'Allumage');
            melcloud::SetPower('true', $this->getEqLogic());
        }
        if ('Off' == $this->logicalId) {
            log::add('melcloud', 'debug', 'Extinction');
            melcloud::SetPower('false', $this->getEqLogic());
        }

        if ('Ventilation' == $this->logicalId) {
            if (isset($_options['slider']) && isset($_options['auto']) == false) {
                melcloud::SetFan($_options['slider'], $this->getEqLogic());
            }
        }

        if ('OperationMode' == $this->logicalId) {
            log::add('melcloud', 'debug', 'Option pour OperationMode : '.var_export($_options,true));
            if (isset($_options['message'])) {
                melcloud::SetMode($_options['message'], $this->getEqLogic());
            }
        }
        if ('refresh' == $this->logicalId) {
            melcloud::pull();
        }
    }
    /*     * **********************Getteur Setteur*************************** */
}

?>