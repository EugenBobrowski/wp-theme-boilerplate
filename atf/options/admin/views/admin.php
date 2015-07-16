<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   GPSTrackingBlog
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>



	<div class="options-panel">
		<?php
		$screen = get_current_screen();
		$i = 0;
		$sectionList = '';
		$sectionBody = '';
		$active = '';
		if (isset($_GET['page'])){
			$activeSect = $_GET['page'];
		} else {
			$activeSect = '';
		}

		foreach ($this->optionsArray as $sectId => $sectValue) {

			$options = get_option(AFT_OPTIONS_PREFIX.$sectId);

			if (isset($sectValue['desc'])) {
				$sectionDesc = $sectValue['desc'];
			}
			else  {
				$sectionDesc = '';
			}

			if (((empty($activeSect) || $activeSect == 'atf-options') && $i == 0) || $activeSect == 'atf-options-' .$sectId) {
				$title = $sectValue['name'];

				$i++;
				$active = 'active';
				$description = $sectionDesc;
			} else {
				$active = '';
			}

			$sectionList .= '<li><a href="#" id="'. $sectId.'" class="'.$active.'" data-section="section_'.$sectId.'" data-description="'.$sectionDesc.'">'.$sectValue['name'].'</a></li>';
			$sectionBody .= '<div id="section_'.$sectId.'" class="one-section-body '.$active.' ">';
			$sectionBody .= '<table class="form-table"><tbody>';

			if (isset($sectValue['content'])) {
				$sectionBody .= $sectValue['content'];
			}
			if (isset($sectValue['incFile'])) {

			}
			if (isset($sectValue['items'])) {

				include_once get_template_directory().'/atf/options/htmlhelper.php';



				foreach ( $sectValue['items'] as $itemId => $item ) {

					if ($item['type'] == 'title') {
						$sectionBody .= '<tr>';
						$sectionBody .= '<th scope="row" colspan="2"><h3 class="title">'.$item['title'].'</h3></th>';
						$sectionBody .= '</tr>';
					} else {

						$item['id'] = $itemId;

						$item['name'] = AFT_OPTIONS_PREFIX.'['.$sectId.']['.$item['id'].']';

						if (!isset($options[$item['id']]) && isset($item['default'])) {
							$item['value'] = $item['default'];
						} else {
							$item['value'] = $options[$item['id']];
						}

						$sectionBody .= '<tr>';
						$sectionBody .= '<th scope="row"><label for="'.$item['id'].'">'.$item['title'].'</label></th>';
						$sectionBody .= '<td>'.AtfHtmlHelper::$item['type']($item).''.'</td>';
						$sectionBody .= '</tr>';
					}


				}

			}


			$sectionBody .= '</tbody></table>';
			$sectionBody .= '</div>';
		}

		?>
		<div class="panel-header">
			<h2><?php echo $title; ?></h2>
			<p class="section-description"><?php echo $description; ?></p>
		</div>
		<div class="sections-section">
			<div class="sections-list">
				<ul>
					<?php echo $sectionList; ?>
				</ul>
			</div>
			<div class="sections-body">
				<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
					<?php wp_nonce_field('update-atfOptions', 'update-atfOptions'); ?>
					<?php echo $sectionBody; ?>
					<div class="submit bottom">
						<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
					</div>
				</form>

			</div>
		</div>
	</div>

</div>
