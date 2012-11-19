<?php 
	/**
	 * This file is part of the IPSLibrary.
	 *
	 * The IPSLibrary is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published
	 * by the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 *
	 * The IPSLibrary is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with the IPSLibrary. If not, see http://www.gnu.org/licenses/gpl.txt.
	 */

	/**@addtogroup ipscam
	 * @{
	 *
	 * @file          IPSCam_Camera.php
	 * @author        Andreas Brauneis
	 * @version
	 *   Version 2.50.1, 10.09.2012<br/>
	 *
	 * File kann in das WebFront bzw. MobileFront eingebunden und erm�glicht den Zugriff auf Kameras
	 *location.reload();
	 */

	/** @}*/
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="0">

		<style type="text/css">html, body { margin: 0; padding: 0; }</style>
		<link href="/user/default.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

		<script type="text/javascript">
			function trigger_button(action, module, info) {
				var serverAddr = "<?echo $_SERVER["HTTP_HOST"];?>";
				var id         = $(this).attr("id");

				$.ajax({type: "POST",
						url: "http://"+serverAddr+"/user/IPSModuleManagerGUI/IPSModuleManagerGUI_Receiver.php",
						data: "id="+id+"&action="+action+"&module="+module+"&info="+info});
			}
		</script>

	</head>
	<body >
		<a href="#" onClick=trigger_button('Refresh','','')>Refresh</a> |
		<a href="#" onClick=trigger_button('Overview','','')>&Uuml;bersicht</a> |
		<a href="#" onClick=trigger_button('Logs','','')>Log File's</a> |
		<a href="#" onClick=trigger_button('Updates','','')>Update's</a> |
		<a href="#" onClick=trigger_button('NewModule','','')>Neues Modul</a>
		<BR>
		<BR>
		<?php
			IPSUtils_Include ("IPSModuleManagerGUI.inc.php", "IPSLibrary::app::modules::IPSModuleManagerGUI");
			
			$baseId  = IPSUtil_ObjectIDByPath('Program.IPSLibrary.data.modules.IPSModuleManagerGUI');
			$action  = GetValue(IPS_GetObjectIDByIdent(IPSMMG_VAR_ACTION, $baseId));
			$module  = GetValue(IPS_GetObjectIDByIdent(IPSMMG_VAR_MODULE, $baseId));
			$info    = GetValue(IPS_GetObjectIDByIdent(IPSMMG_VAR_INFO,   $baseId));

			$processing = !IPSModuleManagerGUI_GetLock();
			if (!$processing) {
				IPSModuleManagerGUI_ReleaseLock();
			}

			switch($action) {
				case IPSMMG_ACTION_OVERVIEW:
					include 'IPSModuleManagerGUI_Overview.php';
					break;
				case IPSMMG_ACTION_UPDATES:
					include 'IPSModuleManagerGUI_Updates.php';
					break;
				case IPSMMG_ACTION_MODULE:
					include 'IPSModuleManagerGUI_Module.php';
					break;
				case IPSMMG_ACTION_LOGS:
					include 'IPSModuleManagerGUI_Logs.php';
					break;
				case IPSMMG_ACTION_LOGFILE:
					include 'IPSModuleManagerGUI_LogFile.php';
					break;
				case IPSMMG_ACTION_NEWMODULE:
					include 'IPSModuleManagerGUI_NewModule.php';
					break;
				default:
					trigger_error('Unknown Action '.$action);
			}
		?>

	</body>
</html>

