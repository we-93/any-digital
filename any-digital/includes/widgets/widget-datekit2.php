<?php
/**
 * Any Digital - Date Kit 2 Widget for Elementor (Simpan di Kalender / Google Calendar)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access prevention
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

class AnyDigital_Widget_Datekit2 extends Widget_Base {

	public function get_name() {
		return 'any-digital-datekit2';
	}

	public function get_title() {
		return __( 'Date Kit 2 (Simpan di Kalender)', 'any-digital' );
	}

	public function get_icon() {
		return 'eicon-calendar';
	}

	public function get_categories() {
		return [ 'any-digital' ];
	}

	public function get_keywords() {
		return [ 'date', 'datekit', 'kalender', 'calendar', 'google calendar', 'simpan', 'any digital' ];
	}

	protected function register_controls() {

		/* -------------------------------------------------------------------------- */
		/*                              CONTENT SECTION                               */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Tombol Kalender', 'any-digital' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => __( 'Teks Tombol', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Simpan di Kalender', 'any-digital' ),
				'placeholder' => __( 'Simpan di Kalender', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'       => __( 'Ikon Tombol', 'any-digital' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'far fa-calendar-alt',
					'library' => 'fa-regular',
				],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   => __( 'Posisi Ikon', 'any-digital' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'row',
				'options' => [
					'row'         => [
						'title' => __( 'Sebelum Teks', 'any-digital' ),
						'icon'  => 'eicon-h-align-left',
					],
					'row-reverse' => [
						'title' => __( 'Setelah Teks', 'any-digital' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .any-digital-datekit-button .elementor-button-content-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'      => __( 'Jarak Ikon', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'size' => 8, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-datekit-button .elementor-button-content-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment Tombol', 'any-digital' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => __( 'Kiri', 'any-digital' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Tengah', 'any-digital' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Kanan', 'any-digital' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .any-digital-datekit-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              EVENT DETAILS SECTION                         */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_event_details',
			[
				'label' => __( 'Detail Acara Kalender', 'any-digital' ),
			]
		);

		$this->add_control(
			'wdp_calendar_title_d',
			[
				'label'       => __( 'Judul Acara (Title)', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Acara Pernikahan Andy & Zhea', 'any-digital' ),
				'placeholder' => __( 'Judul acara...', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'wdp_calendar_description_d',
			[
				'label'       => __( 'Deskripsi Acara (Details)', 'any-digital' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Tanpa mengurangi rasa hormat, kami mengundang Anda untuk berhadir di acara pernikahan kami.', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'wdp_calendar_location_d',
			[
				'label'       => __( 'Lokasi / Alamat Acara', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Gedung / Tempat Acara Pernikahan', 'any-digital' ),
				'placeholder' => __( 'Lokasi acara...', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'wdp_calendar_datetime_start_d',
			[
				'label'       => __( 'Waktu Mulai (Start)', 'any-digital' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date( 'Y-m-d 09:00', strtotime( '+ 30 days' ) ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'wdp_calendar_datetime_end_d',
			[
				'label'       => __( 'Waktu Selesai (End)', 'any-digital' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date( 'Y-m-d 14:00', strtotime( '+ 30 days' ) ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              STYLE SECTIONS                                */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Tombol Kalender', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => __( 'Tipografi Tombol', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-datekit-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		// Normal
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'any-digital' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .any-digital-datekit-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .any-digital-datekit-button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Warna Background', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c89556',
				'selectors' => [
					'{{WRAPPER}} .any-digital-datekit-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover
		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'any-digital' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label'     => __( 'Warna Teks (Hover)', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .any-digital-datekit-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .any-digital-datekit-button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Warna Background (Hover)', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .any-digital-datekit-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'button_border',
				'label'     => __( 'Border Tombol', 'any-digital' ),
				'selector'  => '{{WRAPPER}} .any-digital-datekit-button',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-datekit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-datekit-button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding Tombol', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-datekit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Helper function to format DateTime to Google Calendar UTC ISO format (Ymd\THi00\Z)
	 */
	private function format_gcal_datetime( $datetime_str ) {
		if ( empty( $datetime_str ) ) return '';

		try {
			$dt = new \DateTime( $datetime_str );
			// Return UTC formatted string
			$dt->setTimezone( new \DateTimeZone( 'UTC' ) );
			return $dt->format( 'Ymd\THis\Z' );
		} catch ( \Exception $e ) {
			return '';
		}
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$button_text = ! empty( $settings['text'] ) ? $settings['text'] : __( 'Simpan di Kalender', 'any-digital' );
		$title       = ! empty( $settings['wdp_calendar_title_d'] ) ? $settings['wdp_calendar_title_d'] : '';
		$details     = ! empty( $settings['wdp_calendar_description_d'] ) ? $settings['wdp_calendar_description_d'] : '';
		$location    = ! empty( $settings['wdp_calendar_location_d'] ) ? $settings['wdp_calendar_location_d'] : '';

		$start_str   = ! empty( $settings['wdp_calendar_datetime_start_d'] ) ? $settings['wdp_calendar_datetime_start_d'] : '';
		$end_str     = ! empty( $settings['wdp_calendar_datetime_end_d'] ) ? $settings['wdp_calendar_datetime_end_d'] : '';

		$start_utc   = $this->format_gcal_datetime( $start_str );
		$end_utc     = $this->format_gcal_datetime( $end_str );

		$dates_param = '';
		if ( ! empty( $start_utc ) && ! empty( $end_utc ) ) {
			$dates_param = $start_utc . '/' . $end_utc;
		}

		$gcal_url = 'https://www.google.com/calendar/render?action=TEMPLATE';

		if ( ! empty( $title ) ) {
			$gcal_url .= '&text=' . rawurlencode( $title );
		}
		if ( ! empty( $details ) ) {
			$gcal_url .= '&details=' . rawurlencode( $details );
		}
		if ( ! empty( $location ) ) {
			$gcal_url .= '&location=' . rawurlencode( $location );
		}
		if ( ! empty( $dates_param ) ) {
			$gcal_url .= '&dates=' . rawurlencode( $dates_param );
		}

		$tz_string = get_option( 'timezone_string' );
		if ( ! empty( $tz_string ) ) {
			$gcal_url .= '&ctz=' . rawurlencode( $tz_string );
		}
		?>

		<div class="any-digital-datekit-wrapper">
			<a href="<?php echo esc_url( $gcal_url ); ?>" 
			   target="_blank" 
			   rel="nofollow noopener" 
			   class="any-digital-datekit-button elementor-button" 
			   role="button">
				<div class="elementor-button-content-wrapper">
					<?php if ( ! empty( $settings['selected_icon']['value'] ) ) : ?>
						<span class="elementor-button-icon">
							<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php endif; ?>
					<span class="elementor-button-text"><?php echo esc_html( $button_text ); ?></span>
				</div>
			</a>
		</div>

		<?php
	}
}
