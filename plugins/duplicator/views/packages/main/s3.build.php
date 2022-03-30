<?php
defined('ABSPATH') || defined('DUPXABSPATH') || exit;
//Nonce Check
if (!isset($_POST['dup_form_opts_nonce_field']) || !wp_verify_nonce(sanitize_text_field($_POST['dup_form_opts_nonce_field']), 'dup_form_opts')) {
    DUP_UI_Notice::redirect('admin.php?page=duplicator&tab=new1&_wpnonce='.wp_create_nonce('new1-package'));
}
require_once (DUPLICATOR_PLUGIN_PATH.'classes/package/duparchive/class.pack.archive.duparchive.php');

$retry_nonuce           = wp_create_nonce('new1-package');
$zip_build_nonce        = wp_create_nonce('duplicator_package_build');
$duparchive_build_nonce = wp_create_nonce('duplicator_duparchive_package_build');
$active_package_present = true;

//Help support Duplicator
$atext0  = "<a target='_blank' href='https://wordpress.org/support/plugin/duplicator/reviews/?filter=5'>";
$atext0 .= __('Help review the plugin', 'duplicator') . '!</a>';

//Get even more power & features with Duplicator Pro
$atext1 = __('Want more power?  Try', 'duplicator');
$atext1 .= "&nbsp;<a target='_blank' href='https://snapcreek.com/duplicator/?utm_source=duplicator_free&utm_medium=wordpress_plugin&utm_content=package_build_more_power&utm_campaign=duplicator_pro'>";
$atext1 .= __('Duplicator Pro', 'duplicator').'</a>!';

if (DUP_Settings::Get('installer_name_mode') == DUP_Settings::INSTALLER_NAME_MODE_SIMPLE) {
    $txtInstallHelpMsg = __("When clicking the Installer download button, the 'Save as' dialog will default the name to 'installer.php'. "
        . "To improve the security and get more information, goto: Settings ❯ Packages Tab ❯ Installer Name option.", 'duplicator');
} else {
    $txtInstallHelpMsg = __("When clicking the Installer download button, the 'Save as' dialog will save the name as '[name]_[hash]_[date]_installer.php'. "
        . "This is the secure and recommended option.  For more information goto: Settings ❯ Packages Tab ❯ Installer Name Option.  To quickly copy the hashed "
        . "installer name, to your clipboard use the copy icon link.", 'duplicator');
}

$rand_txt    = array();
$rand_txt[0] = $atext0;

?>

<style>
	a#dup-create-new {margin-left:-5px}
    div#dup-progress-area {text-align:center; max-width:800px; min-height:200px;  border:1px solid silver; border-radius:3px; margin:25px auto 10px auto; padding:0px; box-shadow:0 8px 6px -6px #999;}
    div.dup-progress-title {font-size:22px;padding:5px 0 20px 0; font-weight:bold}
    div#dup-progress-area div.inner {padding:10px; line-height:22px}
    div#dup-progress-area h2.title {background-color:#efefef; margin:0px}
    div#dup-progress-area span.label {font-weight:bold}
    div#dup-msg-success {color:#18592A; padding:5px;}
    div.dup-no-mu {font-size:13px; margin-top:15px; color:maroon; line-height:18px}
    sup.dup-new {font-weight:normal; color:#b10202; font-size:12px}

    div.dup-msg-success-stats{color:#999;margin:5px 0; font-size:11px; line-height:13px}
    div.dup-msg-success-links {margin:20px 5px 5px 5px; font-size:13px;}
    div#dup-progress-area div.done-title {font-size:18px; font-weight:bold; margin:0px 0px 10px 0px}
    div#dup-progress-area div.dup-panel-title {background-color:#dfdfdf;}
	div.hdr-pack-complete {font-size:14px; color:green; font-weight:bold}

    div#dup-create-area-nolink, div#dup-create-area-link {float:right; font-weight:bold; margin:0; padding:0}
    div#dup-create-area-link {display:none; margin-left:-5px}
    div#dup-progress-area div.dup-panel-panel { border-top:1px solid silver}
    fieldset.download-area {border:2px dashed #b5b5b5; padding:20px 20px 20px 20px; border-radius:4px; margin:auto; width:500px }
    fieldset.download-area legend {font-weight:bold; font-size:18px; margin:auto; color:#000}
    button#dup-btn-installer, button#dup-btn-archive { line-height:28px; min-width:175px; height:38px !important; padding-top:3px !important; }
    a#dup-link-download-both {min-width:200px; padding:3px;}
    div.one-click-download {margin:20px 0 10px 0; font-size:16px; font-weight:bold}
    div.one-click-download i.fa-bolt{padding-right:5px}
    div.one-click-download i.fa-file-archive-o{padding-right:5px}

    div.dup-button-footer {text-align:right; margin:20px 10px 0px 0px}
    button.button {font-size:16px !important; height:30px !important; font-weight:bold; padding:0px 10px 5px 10px !important; min-width:150px }
    span.dup-btn-size {font-size:11px;font-weight:normal}
    p.get-pro {font-size:13px; color:#222; border-top:1px solid #eeeeee; padding:5px 0 0 0; margin:0; font-style:italic}
    div.dup-howto-exe {font-size:14px; font-weight:bold; margin:25px 0 40px 0;line-height:20px; color:#000; padding-top:10px;}
    div.dup-howto-exe-title {font-size:18px; margin:0 0 8px 0; color:#000}
    div.dup-howto-exe-title a {text-decoration:none; outline:none; box-shadow:none}
    div.dup-howto-exe small {font-weight:normal; display:block; margin-top:-2px; font-style:italic; font-size:11px; color:#444 }
    div.dup-howto-exe a {margin-top:8px; display:inline-block}
    div.dup-howto-exe-info {display:none; border:1px dotted #b5b5b5; padding:10px 20px 20px 20px; margin:auto; width:500px; background-color:#F0F0F1; border-radius:4px;}
    div.dup-howto-exe-info a i {display:inline-block; margin:0 2px 0 2px}
    div.dup-howto-exe-area {display: flex; justify-content: center;}
    div.dup-howto-exe-txt {text-align: left; font-size:16px}
    span#dup-installer-name {display:inline-block; color:silver; font-style: italic;}
    span#dup-installer-name a {text-decoration: none}
    span#dup-installer-name-help-icon {display:none}

    /*HOST TIMEOUT */
    div#dup-msg-error {color:maroon; padding:5px;}
    div.dup-box-title {text-align:left; background-color:#F6F6F6}
    div.dup-box-title:hover { background-color:#efefef}
    div.dup-box-panel {text-align:left}
    div.no-top {border-top:none}
    div.dup-box-panel b.opt-title {font-size:18px}
    div.dup-msg-error-area {overflow-y:scroll; padding:5px 15px 15px 15px; max-height:170px; width:95%; border:1px solid silver; border-radius:4px; line-height:22px}
    div#dup-logs {text-align:center; margin:auto; padding:5px; width:350px;}
    div#dup-logs a {display:inline-block;}
    span.sub-data {display:inline-block; padding-left:20px}
</style>

<!-- =========================================
TOOL BAR:STEPS -->
<table id="dup-toolbar">
    <tr valign="top">
        <td style="white-space:nowrap">
            <div id="dup-wiz">
                <div id="dup-wiz-steps">
                    <div class="completed-step"><a>1 <?php esc_html_e('Setup', 'duplicator'); ?></a></div>
                    <div class="completed-step"><a>2 <?php esc_html_e('Scan', 'duplicator'); ?> </a></div>
                    <div class="active-step"><a>3 <?php esc_html_e('Build', 'duplicator'); ?> </a></div>
                </div>
                <div id="dup-wiz-title" class="dup-guide-txt-color">
                    <i class="fab fa-wordpress"></i>
                    <?php esc_html_e('Step 3: Build and download the package files.', 'duplicator'); ?>
                </div>
            </div>
        </td>
        <td style="padding-bottom:4px">
            <span>
                <a id="dup-packages-btn" href="?page=duplicator" class="button <?php echo ($active_package_present ? 'no-display' :''); ?>">
                    <?php esc_html_e("Packages",'duplicator'); ?>
                </a>
            </span>                
            <?php
			$package_url = admin_url('admin.php?page=duplicator&tab=new1');
			$package_nonce_url = wp_nonce_url($package_url, 'new1-package');
			?>
			<a id="dup-create-new"
               onclick="return !jQuery(this).hasClass('disabled');"
               href="<?php echo $package_nonce_url;?>"
               class="button <?php echo ($active_package_present ? 'no-display' :''); ?>">
                <?php esc_html_e("Create New", 'duplicator'); ?>
            </a>
        </td>
    </tr>
</table>		
<hr class="dup-toolbar-line">


<form id="form-duplicator" method="post" action="?page=duplicator">
<?php wp_nonce_field('dup_form_opts', 'dup_form_opts_nonce_field', false); ?>

<!--  PROGRESS BAR -->
<div id="dup-progress-bar-area">
	<div class="dup-progress-title"><?php esc_html_e('Building Package', 'duplicator'); ?> <i class="fa fa-cog fa-spin"></i> <span id="dup-progress-percent">0%</span></div>
	<div id="dup-progress-bar"></div>
	<b><?php esc_html_e('Please Wait...', 'duplicator'); ?></b><br/><br/>
	<i><?php esc_html_e('Keep this window open and do not close during the build process.', 'duplicator'); ?></i><br/>
	<i><?php esc_html_e('This may take several minutes to complete.', 'duplicator'); ?></i><br/>
</div>

<div id="dup-progress-area" class="dup-panel" style="display:none">
	<div class="dup-panel-title"><b style="font-size:22px"><?php esc_html_e('Build Status', 'duplicator'); ?></b></div>
	<div class="dup-panel-panel">

		<!--  =========================
		SUCCESS MESSAGE -->
		<div id="dup-msg-success" style="display:none">
			<div class="hdr-pack-complete">
				<i class="far fa-check-square fa-lg"></i> <?php esc_html_e('Package Build Completed', 'duplicator'); ?>
			</div>

			<div class="dup-msg-success-stats">
				<b><?php esc_html_e('Build Time', 'duplicator'); ?>:</b> <span id="data-time"></span><br/>
			</div><br/>

			<!-- DOWNLOAD FILES -->
			<fieldset class="download-area">
				<legend>
					&nbsp; <i class="fa fa-download"></i> <?php esc_html_e("Download Package Files", 'duplicator') ?>  &nbsp;
				</legend>
				<button id="dup-btn-installer" class="button button-primary button-large" title="<?php esc_attr_e("Click to download installer file", 'duplicator') ?>">
					<i class="fa fa-bolt fa-sm"></i> <?php esc_html_e("Installer", 'duplicator') ?> &nbsp;
				</button> &nbsp;
				<button id="dup-btn-archive" class="button button-primary button-large" title="<?php esc_attr_e("Click to download archive file", 'duplicator') ?>">
					<i class="far fa-file-archive"></i> <?php esc_html_e("Archive", 'duplicator') ?>
					<span id="dup-btn-archive-size" class="dup-btn-size"></span> &nbsp;
				</button>
				<div class="one-click-download">
                    <a href="javascript:void(0)" id="dup-link-download-both" title="<?php esc_attr_e("Click to download both files", 'duplicator') ?>" class="button">
                        <i class="fa fa-bolt fa-sm"></i><i class="far fa-file-archive"></i>
                        <?php esc_html_e("Download Both Files",   'duplicator') ?>
					</a>
					<sup>
						<i class="fas fa-question-circle fa-sm" style='font-size:11px'
							data-tooltip-title="<?php esc_attr_e("Download Both Files:", 'duplicator'); ?>"
							data-tooltip="<?php esc_attr_e('Clicking this button will open the installer and archive download prompts one after the other with one click verses '
                                . 'downloading each file separately with two clicks.  On some browsers you may have to disable pop-up warnings on this domain for this to '
                                . 'work correctly.', 'duplicator'); ?>">
						</i>
					</sup>
				</div>
                <div style="margin-top:20px; font-size:11px">
                    <span id="dup-click-to-copy-installer-name" 
                          class="link-style no-decoration"
                          data-dup-copy-text="<?php echo esc_attr(DUP_Installer::DEFAULT_INSTALLER_FILE_NAME_WITHOUT_HASH); ?>">
                        <?php esc_html_e("[Copy Installer Name to Clipboard]", 'duplicator'); ?>
                        <i class="far fa-copy"></i> 
                    </span><br/>
                    <span id="dup-installer-name" data-installer-name="">
                        <a href="javascript:void(0)" onclick="Duplicator.Pack.ShowInstallerName()">
                            <?php esc_html_e("[Show Installer Name]", 'duplicator'); ?>
                        </a>
                    </span>
                    <span id="dup-installer-name-help-icon">
                        <i class="fas fa-question-circle fa-sm"
                            data-tooltip-title="<?php esc_attr_e("Installer Name:", 'duplicator'); ?>"
                            data-tooltip="<?php echo $txtInstallHelpMsg ?>">
                        </i>
                    </span>
                </div>
			</fieldset>

            <?php
                if (is_multisite()) {
                    echo '<div class="dup-no-mu">';
                    echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;';
                    esc_html_e('Notice:Duplicator Lite does not officially support WordPress multisite.', 'duplicator');
                    echo "<br/>";
                    esc_html_e('We strongly recommend upgrading to ', 'duplicator');
                    echo "&nbsp;<i><a href='https://snapcreek.com/duplicator/?utm_source=duplicator_free&utm_medium=wordpress_plugin&utm_content=free_is_mu_warn6&utm_campaign=duplicator_pro' target='_blank'>[" . esc_html__('Duplicator Pro', 'duplicator') . "]</a></i>.";
                    echo '</div>';
                }
            ?>

			<div class="dup-howto-exe">               
                <div class="dup-howto-exe-title" onclick="Duplicator.Pack.ToggleHelpInstall(this)">
                    <a href="javascript:void(0)">
                        <i class="far fa-plus-square"></i>
                        <?php esc_html_e('How to install this package?', 'duplicator'); ?>
                    </a>
                </div>
                <div class="dup-howto-exe-info">
                    <div class="dup-howto-exe-area">
                        <div class="dup-howto-exe-txt">
                            <b style="font-size:18px"><?php esc_html_e("Featured Install Modes", 'duplicator');?></b>
                            <br/>

                            <!-- CLASSIC -->
                            <i class="far fa-save fa-sm fa-fw"></i>
                            <a href="https://snapcreek.com/duplicator/docs/quick-start/?utm_source=duplicator_free&utm_medium=wordpress_plugin&utm_content=package_built_install_help1_collapse&utm_campaign=duplicator_free#quick-040-q" target="_blank">
                                <?php esc_html_e('Classic Install Feature', 'duplicator'); ?>
                                <sup><i class="fas fa-external-link-alt fa-xs"></i></sup>
                            </a><br/>

                            <small>
                                <?php
                                    echo _e('Install to an empty server directory like a new WordPress install does.', 'duplicator');
                                ?>
                            </small>

                            <!-- OVERWRITE -->
                            <i class="far fa-window-close fa-sm fa-fw"></i>
                            <a href="https://snapcreek.com/duplicator/docs/quick-start/?utm_source=duplicator_free&utm_medium=wordpress_plugin&utm_content=package_built_install_help2_collapse&utm_campaign=duplicator_free#quick-043-q" target="_blank">
                                <?php esc_html_e('Overwrite Install Feature', 'duplicator'); ?>
                                <sup><i class="fas fa-external-link-alt fa-xs"></i></sup>
                            </a>
                            <br/>
                            <small><?php esc_html_e("Quickly overwrite an existing WordPress site in a few clicks.", 'duplicator');?></small>


                            <!-- IMPORT -->
                            <i class="fas fa-download fa-sm fa-fw"></i>
                            <a href="https://snapcreek.com/duplicator/docs/quick-start/?utm_source=duplicator_free&utm_medium=wordpress_plugin&utm_content=package_built_install_help3_collapse&utm_campaign=duplicator_free#quick-045-q" target="_blank">
                                <?php esc_html_e('Import Install Feature', 'duplicator'); ?>
                                <sup><i class="fas fa-external-link-alt fa-xs"></i></sup>
                            </a>
                            <sup class="dup-new"><?php esc_html_e('Pro *', 'duplicator'); ?></sup><br/>
                            <small><?php esc_html_e("Easily drag-n-drop the archive file to its destination (requires Pro*)", 'duplicator');?></small>

                        </div>
                    </div>
                </div>
			</div>

			<p class="get-pro">
				<?php echo $rand_txt[array_rand($rand_txt, 1)]; ?>
			</p>
		</div>

		<!--  =========================
		ERROR MESSAGE -->
		<div id="dup-msg-error" style="display:none; color:#000">
			<div class="done-title"><i class="fa fa-chain-broken"></i> <?php esc_html_e('Host Build Interrupt', 'duplicator'); ?></div>
			<b><?php esc_html_e('This server cannot complete the build due to host setup constraints.', 'duplicator'); ?></b><br/>
			<i><?php esc_html_e("To get past this hosts limitation consider the options below by clicking each section.", 'duplicator'); ?></i>
			<br/><br/><br/>

			<!-- OPTION 1:Try DupArchive Engine -->
			<div class="dup-box">
				<div class="dup-box-title">
                    <span style="width:20px; display:inline-block"><i class="far fa-check-circle"></i></span><?php esc_html_e('Option 1:Try DupArchive', 'duplicator'); ?>
					<div class="dup-box-arrow"><i class="fa fa-caret-down"></i></div>
				</div>
				<div class="dup-box-panel" id="dup-pack-build-try1" style="display:none">
					<!--<b class="opt-title"><?php esc_html_e('OPTION 1:', 'duplicator'); ?></b><br/>-->

					<?php esc_html_e('Enable the DupArchive format which is specific to Duplicator and designed to perform better on constrained budget hosts.', 'duplicator'); ?>
					<br/><br/>

					<div style="font-style:italic">
						<?php esc_html_e('Note:DupArchive on Duplicator only supports sites up to 500MB.  If your site is over 500MB then use a file filter on step 1 to get the size '
						. 'below 500MB or try the other options mentioned below.  Alternatively, you may want to consider',
						'duplicator'); ?> 
						<a href="https://snapcreek.com/duplicator/?utm_source=duplicator_free&amp;utm_medium=wordpress_plugin&amp;utm_content=build_interrupt&amp;utm_campaign=duplicator_pro" target="_blank">
							Duplicator Pro,
						</a>
                        <?php esc_html_e(' which is capable of migrating sites much larger than 500MB.'); ?>
					</div><br/>

					<b><i class="far fa-file-alt fa-sm"></i> <?php esc_html_e('Overview', 'duplicator'); ?></b><br/>
					<?php esc_html_e('Please follow these steps:', 'duplicator'); ?>
					<ol>
						<li><?php esc_html_e('On the scanner step check to make sure your package is under 500MB. If not see additional options below.', 'duplicator'); ?></li>
						<li>
							<?php esc_html_e('Go to Duplicator &gt; Settings &gt; Packages Tab &gt; Archive Engine &gt;', 'duplicator'); ?>
							<a href="admin.php?page=duplicator-settings&tab=package"><?php esc_html_e('Enable DupArchive', 'duplicator'); ?></a>
						</li>
						<li><?php esc_html_e('Build a new package using the new engine format.', 'duplicator'); ?></li>
					</ol>

					<small style="font-style:italic">
						<?php esc_html_e('Note:The DupArchive engine will generate an archive.daf file. This file is very similar to a .zip except that it can only be extracted by the '
							. 'installer.php file or the', 'duplicator'); ?>
						<a href="https://snapcreek.com/duplicator/docs/faqs-tech/#faq-trouble-052-q" target="_blank"><?php esc_html_e('commandline extraction tool'); ?></a>.
					</small>
				</div>
			</div>

			<!-- OPTION 2:TRY AGAIN -->
			<div class="dup-box  no-top">
				<div class="dup-box-title">
					<span style="width:20px; display:inline-block"><i class="fa fa-filter fa-sm"></i></span><?php esc_html_e('Option 2:File Filters', 'duplicator'); ?>
					<div class="dup-box-arrow"><i class="fa fa-caret-down"></i></div>
				</div>
				<div class="dup-box-panel" id="dup-pack-build-try2" style="display:none">
					<?php
						esc_html_e('The first pass for reading files on some budget hosts maybe slow and have conflicts with strict timeout settings setup by the hosting provider.  '
						. 'In these cases, it is recommended to retry the build by adding file filters to larger files/directories.', 'duplicator');

						echo '	<br/><br/>';

						esc_html_e('For example, you could  filter out the  "/wp-content/uploads/" folder to create the package then move the files from that directory over manually.  '
							. 'If this work-flow is not desired or does not work please check-out the other options below.', 'duplicator');
					?>
					<br/><br/>
					<div style="text-align:center; margin:10px 0 2px 0">
						<input type="button" class="button-large button-primary" value="<?php esc_attr_e('Retry Build With Filters', 'duplicator'); ?>" onclick="window.history.back()" />
					</div>

					<div style="color:#777; padding:15px 5px 5px 5px">
						<b> <?php esc_html_e('Notice', 'duplicator'); ?></b><br/>
						<?php
						printf('<b><i class="fa fa-folder-o"></i> %s %s</b> <br/> %s', esc_html__('Build Folder:'), DUP_Settings::getSsdirTmpPath(),
							__("On some servers the build will continue to run in the background. To validate if a build is still running; open the 'tmp' folder above and see "
								."if the archive file is growing in size or check the main packages screen to see if the package completed. If it is not then your server "
								."has strict timeout constraints.", 'duplicator')
						);
						?>
					</div>
				</div>
			</div>

			<!-- OPTION 3:Two-Part Install -->
			<div class="dup-box no-top">
				<div class="dup-box-title">
					<span style="width:20px; display:inline-block"><i class="fa fa-random"></i></span><?php esc_html_e('Option 3:Two-Part Install', 'duplicator'); ?>
					<div class="dup-box-arrow"><i class="fa fa-caret-down"></i></div>
				</div>
				<div class="dup-box-panel" id="dup-pack-build-try2" style="display:none">


					<?php esc_html_e('A two-part install minimizes server load and can avoid I/O and CPU issues encountered on some budget hosts. With this procedure you simply build a '
						.'\'database-only\' archive, manually move the website files, and then run the installer to complete the process.', 'duplicator');
					?><br/><br/>

					<b><i class="far fa-file-alt fa-sm"></i><?php esc_html_e(' Overview', 'duplicator'); ?></b><br/>
						<?php esc_html_e('Please follow these steps:', 'duplicator'); ?><br/>
					<ol>
						<li><?php esc_html_e('Click the button below to go back to Step 1.', 'duplicator'); ?></li>
						<li><?php esc_html_e('On Step 1 the "Archive Only the Database" checkbox will be auto checked.', 'duplicator'); ?></li>
						<li>
							<?php esc_html_e('Complete the package build and follow the ', 'duplicator'); ?>
							<?php
							printf('%s "<a href="https://snapcreek.com/duplicator/docs/quick-start/?utm_source=duplicator_free&utm_medium=wordpress_plugin&utm_content=host_interupt_2partlink2&utm_campaign=build_issues#quick-060-q" target="faq">%s</a>".',
								'', esc_html__('Quick Start Two-Part Install Instructions', 'duplicator'));
							?>
						</li>
					</ol>

					<div style="text-align:center; margin:10px">
						<input type="checkbox" id="dup-two-part-check" onclick="Duplicator.Pack.ToggleTwoPart()">
						<label for="dup-two-part-check"><?php esc_html_e('Yes. I have read the above overview and would like to continue!', 'duplicator'); ?></label><br/><br/>
						<button id="dup-two-part-btn"  type="button" class="button-large button-primary" disabled="true" onclick="window.location = 'admin.php?page=duplicator&tab=new1&retry=2&_wpnonce=<?php echo $retry_nonuce; ?>'">
							<i class="fa fa-random"></i> <?php esc_html_e('Start Two-Part Install Process', 'duplicator'); ?>
						</button>
					</div><br/>
				</div>
			</div>

			<!-- OPTION 4:DIAGNOSE SERVER -->
			<div class="dup-box no-top">
				<div class="dup-box-title">
                    <span style="width:20px; display:inline-block"><i class="fa fa-cog"></i></span><?php esc_html_e('Option 4:Configure Server', 'duplicator'); ?>
					<div class="dup-box-arrow"><i class="fa fa-caret-down"></i></div>
				</div>
				<div class="dup-box-panel" id="dup-pack-build-try3" style="display:none">
				<!--	<b class="opt-title"><?php esc_html_e('OPTION 4:', 'duplicator'); ?></b><br/>-->
					<?php esc_html_e('This option is available on some hosts that allow for users to adjust server configurations.  With this option you will be directed to an '
						. 'FAQ page that will show various recommendations you can take to improve/unlock constraints set up on this server.', 'duplicator');
					?><br/><br/>

					<div style="text-align:center; margin:10px; font-size:16px; font-weight:bold">
						<a href="https://snapcreek.com/duplicator/docs/faqs-tech/?utm_source=duplicator_free&utm_medium=wordpress_plugin&utm_content=host_interupt_diagnosebtn&utm_campaign=build_issues#faq-trouble-100-q" target="_blank">
							[<?php esc_html_e('Diagnose Server Setup', 'duplicator'); ?>]
						</a>
					</div>

					<b><?php esc_html_e('RUNTIME DETAILS', 'duplicator'); ?>:</b><br/>
					<div class="dup-msg-error-area">
						<div id="dup-msg-error-response-time">
							<span class="label"><?php esc_html_e("Allowed Runtime:", 'duplicator'); ?></span>
							<span class="data"></span>
						</div>
						<div id="dup-msg-error-response-php">
							<span class="label"><?php esc_html_e("PHP Max Execution", 'duplicator'); ?></span><br/>
							<span class="data sub-data">
								<span class="label"><?php esc_html_e("Time", 'duplicator'); ?>:</span>
								<?php
								$try_value   = @ini_get('max_execution_time');
								$try_update  = set_time_limit(0);
								echo "$try_value <a href='http://www.php.net/manual/en/info.configuration.php#ini.max-execution-time' target='_blank'> (default)</a>";
								?>
								<i class="fa fa-question-circle data-size-help"
								   data-tooltip-title="<?php esc_attr_e("PHP Max Execution Time", 'duplicator'); ?>"
								   data-tooltip="<?php esc_attr_e('This value is represented in seconds. A value of 0 means no timeout limit is set for PHP.',    'duplicator'); ?>"></i>
							</span><br/>

							<span class="data sub-data">
								<span class="label"><?php esc_html_e("Mode", 'duplicator'); ?>:</span>
								   <?php
								   $try_update  = $try_update ? 'is dynamic' :'value is fixed';
								   echo "{$try_update}";
								   ?>
								<i class="fa fa-question-circle data-size-help"
								   data-tooltip-title="<?php esc_attr_e("PHP Max Execution Mode", 'duplicator'); ?>"
								   data-tooltip="<?php
								   esc_html_e('If the value is [dynamic] then its possible for PHP to run longer than the default.  '
									   .'If the value is [fixed] then PHP will not be allowed to run longer than the default. <br/><br/> If this value is larger than the [Allowed Runtime] above then '
									   .'the web server has been enabled with a timeout cap and is overriding the PHP max time setting.', 'duplicator');
								   ?>"></i>
							</span>
						</div>

						<div id="dup-msg-error-response-status">
							<span class="label"><?php esc_html_e("Server Status:", 'duplicator'); ?></span>
							<span class="data"></span>
						</div>
						<div id="dup-msg-error-response-text">
							<span class="label"><?php esc_html_e("Error Message:", 'duplicator'); ?></span><br/>
							<span class="data"></span>
						</div>
					</div>

					<!-- LOGS -->
					<div id="dup-logs">
						<br/>
						<i class="fa fa-list-alt"></i>
						<a href='javascript:void(0)' style="color:#000" onclick='Duplicator.OpenLogWindow(true)'><?php esc_html_e('Read Package Log File',
									   'duplicator'); ?></a>
						<br/><br/>
					</div>
				</div>
			</div>




			<br/><br/><br/>
		</div>

	</div>
</div>
</form>

<script>
jQuery(document).ready(function ($)
{

	Duplicator.Pack.DupArchiveFailureCount = 0;
	Duplicator.Pack.DupArchiveMaxRetries = 10;
	Duplicator.Pack.DupArchiveRetryDelayInMs = 8000;
	Duplicator.Pack.DupArchiveStartTime = new Date().getTime();
	Duplicator.Pack.StatusFrequency = 8000;

	/*	----------------------------------------
	 *	METHOD:Performs Ajax post to create a new package
	 *	Timeout (10000000 = 166 minutes)  */
	Duplicator.Pack.CreateZip = function ()
	{
		var startTime;
		var data = {action:'duplicator_package_build', nonce:'<?php echo esc_js($zip_build_nonce); ?>'}
		var statusInterval = setInterval(Duplicator.Pack.GetActivePackageStatus, Duplicator.Pack.StatusFrequency);

		$.ajax({
			type:"POST",
			cache:false,
			dataType:"text",
			url:ajaxurl,
			timeout:0, // no timeout
			data:data,
			beforeSend:function () {
				startTime = new Date().getTime();
			},
			complete:function () {
				Duplicator.Pack.PostTransferCleanup(statusInterval, startTime);
			},
			success:function (respData, textStatus, xHr) {
				try {
					var data = Duplicator.parseJSON(respData);
				} catch(err) {
					console.error(err);
					console.error('JSON parse failed for response data:' + respData);
					$('#dup-progress-bar-area').hide();
					$('#dup-progress-area, #dup-msg-error').show(200);
					var status = xHr.status + ' -' + data.statusText;
					var response = (xHr.responseText != undefined && xHr.responseText.trim().length > 1) ? xHr.responseText.trim() :'No client side error - see package log file';
					$('#dup-msg-error-response-status span.data').html(status)
					$('#dup-msg-error-response-text span.data').html(response);
					console.log(xHr);
					return false;
				}
                
                if ((data != null) && (typeof (data) != 'undefined') && data.status == 1) {
                    Duplicator.Pack.WireDownloadLinks(data);
                } else {
                    var message = (typeof (data.error) != 'undefined' && data.error.length) ? data.error :'Error processing package';
                    Duplicator.Pack.DupArchiveProcessingFailed(message);
                }
                
			},
			error:function (xHr) {
				$('#dup-progress-bar-area').hide();
				$('#dup-progress-area, #dup-msg-error').show(200);
				var status = xHr.status + ' -' + data.statusText;
				var response = (xHr.responseText != undefined && xHr.responseText.trim().length > 1) ? xHr.responseText.trim() :'No client side error - see package log file';
				$('#dup-msg-error-response-status span.data').html(status)
				$('#dup-msg-error-response-text span.data').html(response);
				console.log(xHr);
			}
		});
		return false;
	}

	/*	----------------------------------------
	 *	METHOD:Performs Ajax post to create a new DupArchive-based package */
	Duplicator.Pack.CreateDupArchive = function ()
	{
		console.log('Duplicator.Pack.CreateDupArchive');
		var data = {action:'duplicator_duparchive_package_build', nonce:'<?php echo esc_js($duparchive_build_nonce); ?>'}
		var statusInterval = setInterval(Duplicator.Pack.GetActivePackageStatus, Duplicator.Pack.StatusFrequency);
        
		$.ajax({
			type:"POST",
			timeout:0, // no timeout
			dataType:"text",
			url:ajaxurl,
			data:data,
			complete:function () {
				Duplicator.Pack.PostTransferCleanup(statusInterval, Duplicator.Pack.DupArchiveStartTime);
			},
			success:function (respData, textStatus, xHr) {
				try {
					var data = Duplicator.parseJSON(respData);
				} catch(err) {
					console.log(err);
					console.log('JSON parse failed for response data:' + respData);
					console.log('DupArchive AJAX error!');
					console.log("jqHr:");
					console.log(xHr);
					console.log("textStatus:");
					console.log(textStatus);
					Duplicator.Pack.HandleDupArchiveInterruption(xHr.responseText);
					return false;
				}

				console.log("CreateDupArchive:AJAX success. Data equals:");

				console.log(data);
				// DATA FIELDS
				// archive_offset, archive_size, failures, file_index, is_done, timestamp

				if ((data != null) && (typeof (data) != 'undefined') && ((data.status == 1) || (data.status == 3) || (data.status == 4))) {

					Duplicator.Pack.DupArchiveFailureCount = 0;

					// Status = 1 means complete, 4 means more to process
					console.log("CreateDupArchive:Passed");
					var criticalFailureText = Duplicator.Pack.GetFailureText(data.failures, true);

					if (data.failures.length > 0) {
						console.log("CreateDupArchive:There are failures present. (" + data.failures.length) + ")";
					}

					if ((criticalFailureText === '') && (data.status != 3)) {
						console.log("CreateDupArchive:No critical failures");
						if (data.status == 1) {

							// Don't stop for non-critical failures - just display those at the end TODO:put these in the log not popup
							console.log("CreateDupArchive:archive has completed");
							if (data.failures.length > 0) {

								console.log(data.failures);
								var errorMessage = "CreateDupArchive:Problems during package creation. These may be non-critical so continue with install.\n------\n";
								var len = data.failures.length;

								for (var j = 0; j < len; j++) {
									failure = data.failures[j];
									errorMessage += failure + "\n";
								}
								alert(errorMessage);
							}

						    Duplicator.Pack.WireDownloadLinks(data);

						} else {
							// data.Status == 4
							console.log('CreateDupArchive:Archive not completed so continue ping DAWS in 500');
							setTimeout(Duplicator.Pack.CreateDupArchive, 500);
						}
					} else {

						console.log("CreateDupArchive:critical failures present");
						// If we get a critical failure it means it's something we can't recover from so no purpose in retrying, just fail immediately.
						var errorString = 'Error Processing Step 1<br/>';
						errorString += criticalFailureText;
						Duplicator.Pack.DupArchiveProcessingFailed(errorString);
					}
				} else {
					// data is null or Status is warn or fail
					var errorString = '';
					if(data == null) {
						errorString = "Data returned from web service is null.";
					}
					else {
						var errorString = '';
						if(data.failures.length > 0) {
							errorString += Duplicator.Pack.GetFailureText(data.failures, false);
						}
					}
					Duplicator.Pack.HandleDupArchiveInterruption(errorString);
				}
			},
			error:function (xHr, textStatus) {
				console.log('DupArchive AJAX error!');
				console.log("jqHr:");
				console.log(xHr);
				console.log("textStatus:");
				console.log(textStatus);
				Duplicator.Pack.HandleDupArchiveInterruption(xHr.responseText);
			}
		});
	};

	/*	----------------------------------------
	 *	METHOD:Retrieves package status and updates UI with build percentage */
	Duplicator.Pack.GetActivePackageStatus = function ()
	{
		var data = {action:'DUP_CTRL_Package_getActivePackageStatus', nonce:'<?php echo wp_create_nonce('DUP_CTRL_Package_getActivePackageStatus'); ?>'}
		console.log('####Duplicator.Pack.GetActivePackageStatus');

		$.ajax({
			type:"POST",
			url:ajaxurl,
			dataType:"text",
			timeout:0, // no timeout
			data:data,
			success:function (respData, textStatus, xHr) {
				try {
					var data = Duplicator.parseJSON(respData);
				} catch(err) {
					console.error(err);
					console.error('JSON parse failed for response data:' + respData);
					console.log('Error retrieving build status');
                    console.log(xHr);
					return false;
				}
				if(data.report.status == 1) {
					$('#dup-progress-percent').html(data.payload.status + "%");
				} else {
					console.log('Error retrieving build status');
					console.log(data);
				}
			},
			error:function (xHr) {
				console.log('Error retrieving build status');
				console.log(xHr);
			}
		});
		return false;
	}

	Duplicator.Pack.PostTransferCleanup = function(statusInterval, startTime)
	{
		clearInterval(statusInterval);
		endTime = new Date().getTime();
		var millis = (endTime - startTime);
		var minutes = Math.floor(millis / 60000);
		var seconds = ((millis % 60000) / 1000).toFixed(0);
		var status = minutes + ":" + (seconds < 10 ? '0' :'') + seconds;
		$('#dup-msg-error-response-time span.data').html(status);
		//$('#dup-create-area-nolink').hide();
		//$('#dup-create-area-link').show();
	};

	Duplicator.Pack.WireDownloadLinks = function(data)
	{
		var pack = data.package;
		var archive_json = {
		    filename:pack.Archive.File,
            url:"<?php echo DUP_Settings::getSsdirUrl(); ?>" + "/" + pack.Archive.File
        };
		var installer_json = {
		    id:pack.ID,
            hash:pack.Hash
        };

		$('#dup-progress-bar-area').hide();
		$('#dup-progress-area, #dup-msg-success').show(300);

		$('#dup-btn-archive-size').append('&nbsp; (' + data.archiveSize + ')')
		$('#data-name-hash').text(pack.NameHash || 'error read');
		$('#data-time').text(data.runtime || 'unable to read time');
        $('#dup-create-new').removeClass('no-display');
        $('#dup-packages-btn').removeClass('no-display');
        
		//Wire Up Downloads
		$('#dup-btn-installer').click(function() {
		    Duplicator.Pack.DownloadInstaller(installer_json);
		    return false;
		});

		$('#dup-btn-archive').click(function() {
			Duplicator.Pack.DownloadFile(archive_json);
			return false;
		});

		$('#dup-link-download-both').on("click", function () {
			$('#dup-btn-installer').trigger('click');
			setTimeout(function(){
				$('#dup-btn-archive').trigger('click');
			}, 700);
			return false;
		});
		
		$('#dup-click-to-copy-installer-name').data('dup-copy-text', data.instDownloadName);
        $('#dup-installer-name').data('data-installer-name', data.instDownloadName);
	};

	Duplicator.Pack.HandleDupArchiveInterruption = function (errorText)
	{
		Duplicator.Pack.DupArchiveFailureCount++;

		if (Duplicator.Pack.DupArchiveFailureCount <= Duplicator.Pack.DupArchiveMaxRetries) {
			console.log("Failure count:" + Duplicator.Pack.DupArchiveFailureCount);
			// / rsr todo don’t worry about this right now Duplicator.Pack.DupArchiveThrottleDelay = 9;	// Equivalent of 'low' server throttling (ms)
			console.log('Relaunching in ' + Duplicator.Pack.DupArchiveRetryDelayInMs);
			setTimeout(Duplicator.Pack.CreateDupArchive, Duplicator.Pack.DupArchiveRetryDelayInMs);
		} else {
			console.log('Too many failures.' + errorText);
			// Processing problem
			Duplicator.Pack.DupArchiveProcessingFailed("Too many retries when building DupArchive package. " + errorText);
		}
	};

	Duplicator.Pack.DupArchiveProcessingFailed = function (errorText)
	{
		$('#dup-progress-bar-area').hide();
		$('#dup-progress-area, #dup-msg-error').show(200);
		$('#dup-msg-error-response-text span.data').html(errorText);
	};

	Duplicator.Pack.GetFailureText = function (failures, onlyCritical)
	{
		var retVal = '';

		if ((failures !== null) && (typeof failures !== 'undefined')) {
			var len = failures.length;

			for (var j = 0; j < len; j++) {
				failure = failures[j];
				if (!onlyCritical || failure.isCritical) {
					retVal += failure.description;
					retVal += "<br/>";
				}
			}
		}
		return retVal;
	};

	Duplicator.Pack.ToggleTwoPart = function () {
		var $btn = $('#dup-two-part-btn');
		if ($('#dup-two-part-check').is(':checked')) {
			$btn.removeAttr("disabled");
		} else {
			$btn.attr("disabled", true);
		}
	};

    Duplicator.Pack.ToggleHelpInstall = function (div) {
		var $div    = $(div);
        var $icon   = $div.find('i.far')
        var $info   = $('div.dup-howto-exe-info');
		if ($icon.hasClass('fa-plus-square')) {
			$icon.attr('class', 'far fa-minus-square');
            $info.show();
		} else {
			$icon.attr('class', 'far fa-plus-square');
            $info.hide();
		}
	};

    Duplicator.Pack.ShowInstallerName = function () {
		var txt = $('#dup-installer-name').data('data-installer-name');
        $('#dup-installer-name').html(txt);
        $('#dup-installer-name-help-icon').show();
        
	};

	//Page Init:
	Duplicator.UI.AnimateProgressBar('dup-progress-bar');

	<?php if (DUP_Settings::Get('archive_build_mode') == DUP_Archive_Build_Mode::ZipArchive):?>
		Duplicator.Pack.CreateZip();
	<?php else:?>
		Duplicator.Pack.CreateDupArchive();
	<?php endif; ?>
});
</script>
