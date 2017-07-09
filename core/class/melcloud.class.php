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
            $json = $request->exec(30000, 2);
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
            $json = $request->exec(30000, 2);
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
            $json = $request->exec(30000, 2);
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
        log::add('melcloud', 'debug', 'SetMode' . $newmode);
        $montoken = config::byKey('MyToken', 'melcloud', '');
        if ($montoken != '') {
            $devideid = $mylogical->getConfiguration('deviceid');
            $buildid = $mylogical->getConfiguration('buildid');
            $request = new com_http('https://app.melcloud.com/Mitsubishi.Wifi.Client/Device/Get?id=' . $devideid . '&buildingID=' . $buildid);
            $request->setHeader(array('X-MitsContextKey: ' . $montoken));
            $json = $request->exec(30000, 2);
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
            self::nextCommunication($json,$mylogical);
        }
    }

    private static function nextCommunication($json,$mylogical,$power=false,$option=null) {
        foreach ($mylogical->getCmd() as $cmd) {
            if ('NextCommunication' == $cmd->getName()) {
                $cmd->setCollectDate('');
                $time = strtotime($json['NextCommunication'] . " + 1 hours"); // Add 1 hour
                $time = date('G:i:s', $time); // Back to string
                $cmd->event($time);
            } else if ($power &&'Power' == $cmd->getName()) {
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
            $json = $request->exec(30000, 2);
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
            if ($mylogical->getConfiguration('namemachine') != $device['DeviceName']) continue;
            log::add('melcloud', 'debug', 'setdevice ' . $device['Device']['DeviceID']);
            $mylogical->setConfiguration('deviceid', $device['Device']['DeviceID']);
            $mylogical->setConfiguration('buildid', $device['BuildingID']);
            $mylogical->save();
            foreach ($mylogical->getCmd() as $cmd) {
                //il faut exclure le on/off
                switch ($cmd->getName()) {
                    case 'On':
                    case 'Off':
                        log::add('melcloud', 'debug', 'log ' . $cmd->getName() . ' : On ne traite pas cette commande');
                        break;
                    case 'Mode':
                        log::add('melcloud', 'debug', 'log ' . $cmd->getName() . ' ' . $device['Device']['OperationMode']);
                        $cmd->setCollectDate('');
                        $cmd->event($device['Device']['OperationMode']);
                        break;
                    case 'Ventilation':
                        log::add('melcloud', 'debug', 'log ' . $cmd->getName() . ' ' . $device['Device']['FanSpeed']);
                        $cmd->setCollectDate('');
                        $cmd->event($device['Device']['FanSpeed']);
                        break;
                    case 'Consigne':
                        log::add('melcloud', 'debug', 'log ' . $cmd->getName() . ' ' . $device['Device']['SetTemperature']);
                        $cmd->setCollectDate('');
                        $cmd->event($device['Device']['SetTemperature']);
                        break;
                    default:
                        log::add('melcloud', 'debug', 'log ' . $cmd->getName() . ' ' . $device['Device'][$cmd->getName()]);
                        if ('LastTimeStamp' == $cmd->getName()) {
                            $cmd->event(str_replace('T', ' ', $device['Device'][$cmd->getName()]));
                        } else {
                            $cmd->setCollectDate('');
                            $cmd->event($device['Device'][$cmd->getName()]);
                        }
                        $cmd->save();
                        break;
                }
            }
            $mylogical->Refresh();
            $mylogical->toHtml('dashboard');
            $mylogical->refreshWidget();
        }
    }

    //Fonction exécutée automatiquement toutes les minutes par Jeedom
    public static function cron(){}

    //Fonction exécutée automatiquement toutes les heures par Jeedom
    public static function cronHourly(){}


    // Fonction exécutée automatiquement tous les jours par Jeedom
    public static function cronDayly(){}


    /*     * *********************Méthodes d'instance************************* */

    public function preInsert(){}

    public function postInsert()
    {
        $RoomTemperature = new melcloudCmd();
        $RoomTemperature->setName('RoomTemperature');
        $RoomTemperature->setEqLogic_id($this->getId());
        $RoomTemperature->setLogicalId('temperature');
        $RoomTemperature->setType('info');
        $RoomTemperature->setSubType('numeric');
        $RoomTemperature->setIsHistorized(0);
        $RoomTemperature->setIsVisible(1);
        $RoomTemperature->setUnite('°C');
        $RoomTemperature->setTemplate('dashboard', 'tile');
        $RoomTemperature->save();
        $RoomTemperature->setValue(0);
        $RoomTemperature->event(0);

        $SetTemperature = new melcloudCmd();
        $SetTemperature->setName('SetTemperature');
        $SetTemperature->setEqLogic_id($this->getId());
        $SetTemperature->setLogicalId('temperature');
        $SetTemperature->setType('info');
        $SetTemperature->setSubType('numeric');
        $SetTemperature->setIsHistorized(0);
        $SetTemperature->setUnite('°C');
        $SetTemperature->setTemplate('dashboard', 'tile');
        $SetTemperature->setIsVisible(1);
        $SetTemperature->save();
        $SetTemperature->setValue(0);
        $SetTemperature->event(0);

        $Consigne = new melcloudCmd();
        $Consigne->setName('Consigne');
        $Consigne->setEqLogic_id($this->getId());
        $Consigne->setLogicalId('temperature');
        $Consigne->setType('action');
        $Consigne->setTemplate('dashboard', 'thermostat');
        $Consigne->setSubType('slider');
        $Consigne->setIsHistorized(0);
        $Consigne->setUnite('°C');
        $Consigne->setIsVisible(1);
        $Consigne->setDisplay('slider_placeholder', 'Temperature en °c ex');
        $Consigne->setConfiguration('maxValue', 30);
        $Consigne->setConfiguration('minValue', 10);
        $Consigne->save();


        $onoff_state = $this->getCmd(null, 'onoff_state');
        if (!is_object($onoff_state)) {
            $onoff_state = new melcloudCmd();
            $onoff_state->setLogicalId('onoff_state');
            $onoff_state->setIsVisible(1);
            $onoff_state->setName(__('Power', __FILE__));
        }
        $onoff_state->setType('info');
        $onoff_state->setSubType('binary');
        $onoff_state->setEqLogic_id($this->getId());
        $onoff_state->save();

        $on = new melcloudCmd();
        $on->setName('On');
        $on->setLogicalId('on');
        $on->setEqLogic_id($this->getId());
        $on->setType('action');
        $on->setSubType('other');
        $on->setIsHistorized(0);
        $on->setIsVisible(1);
        $on->setDisplay('generic_type', 'ENERGY_ON');
        $on->setConfiguration('updateCmdId', $onoff_state->getEqLogic_id());
        $on->setConfiguration('updateCmdToValue', 1);
        $on->setValue($onoff_state->getId());
        $on->save();

        $off = new melcloudCmd();
        $off->setName('Off');
        $off->setLogicalId('off');
        $off->setEqLogic_id($this->getId());
        $off->setType('action');
        $off->setSubType('other');
        $off->setIsHistorized(0);
        $off->setIsVisible(1);
        $off->setDisplay('generic_type', 'ENERGY_OFF');
        $off->setConfiguration('updateCmdId', $onoff_state->getEqLogic_id());
        $off->setConfiguration('updateCmdToValue', 0);
        $off->setValue($onoff_state->getId());
        $off->save();


        $ventilation = new melcloudCmd();
        $ventilation->setName('Ventilation');
        $ventilation->setEqLogic_id($this->getId());
        $ventilation->setType('action');
        $ventilation->setSubType('slider');
        $ventilation->setIsHistorized(0);
        $ventilation->setDisplay('slider_placeholder', '0 = automatique, 1 a 5 manuel');
        $ventilation->setTemplate('dashboard', 'thermostat');
        $ventilation->setIsVisible(0);
        $ventilation->setConfiguration('maxValue', 5);
        $ventilation->setConfiguration('minValue', 0);
        $ventilation->save();

        $mode = new melcloudCmd();
        $mode->setName('Mode');
        $mode->setEqLogic_id($this->getId());
        $mode->setType('action');
        $mode->setSubType('slider');
        $mode->setDisplay('slider_placeholder', 'Chaud : 1 Seche : 2 Rafraichir : 3 Ventilation : 7 Auto :');
        $mode->setIsHistorized(0);
        $mode->setIsVisible(0);
        $mode->save();

        $actualFanSpeed = new melcloudCmd();
        $actualFanSpeed->setName('ActualFanSpeed');
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

        $FanSpeed = new melcloudCmd();
        $FanSpeed->setName('FanSpeed');
        $FanSpeed->setEqLogic_id($this->getId());
        $FanSpeed->setLogicalId('FanSpeed');
        $FanSpeed->setType('info');
        $FanSpeed->setSubType('numeric');
        $FanSpeed->setIsHistorized(0);
        $FanSpeed->setTemplate('dashboard', 'tile');
        $FanSpeed->setIsVisible(1);
        $FanSpeed->save();
        $FanSpeed->setValue(0);
        $FanSpeed->event(0);
    }

    public function preSave(){}

    public function postSave(){}

    public function preUpdate(){}

    public function postUpdate(){}

    public function preRemove(){}

    public function postRemove(){}
    /*
     * Non obligatoire mais permet de modifier l'affichage du widget si vous en avez besoin
      public function toHtml($_version = 'dashboard') {

      }
     */

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
        if ('Consigne' ==  $this->name) {
            if (isset($_options['slider']) && isset($_options['auto']) == false) {
                melcloud::SetTemp($_options['slider'], $this->getEqLogic());
            }
        }
        if ('On' == $this->name) {
            log::add('melcloud', 'debug', 'Allumage');
            melcloud::SetPower('true', $this->getEqLogic());
        }
        if ('Off' == $this->name) {
            log::add('melcloud', 'debug', 'Extinction');
            melcloud::SetPower('false', $this->getEqLogic());
        }

        if ('Ventilation' == $this->name) {
            if (isset($_options['slider']) && isset($_options['auto']) == false) {
                melcloud::SetFan($_options['slider'], $this->getEqLogic());
            }
        }

        if ('Mode' == $this->name) {
            if (isset($_options['slider']) && isset($_options['auto']) == false) {
                melcloud::SetMode($_options['slider'], $this->getEqLogic());
            }
        }
        if ('Rafraichir' == $this->name) {
            melcloud::pull();
        }
    }
    /*     * **********************Getteur Setteur*************************** */
}

?>