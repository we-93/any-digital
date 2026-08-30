<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

class AnyDigital_Widget_Scroll_Navigation extends \Elementor\Widget_Base {

	public function get_name() {
		return 'any-digital-autoscroll';
	}

	public function get_title() {
		return __( 'Scroll Navigation', 'any-digital' );
	}

	public function get_icon() {
		return 'apeiron-icon-scroll';
	}

	public function get_keywords() {
		return [ 'scroll', 'auto', 'navigation', 'button', 'page scroll', 'smooth' ];
	}

	public function get_style_depends() {
		$styles = parent::get_style_depends();
		
		return $styles;
	}

	public function get_script_depends() {
		return [];
	}

	protected function register_controls() {
		

		

		// ==================== CONTENT TAB ====================

		// General Settings Section
		$this->start_controls_section(
			'section_general',
			[
				'label' => __( 'Pengaturan Umum', 'any-digital' ),
			]
		);

		$this->add_control(
			'scroll_mode',
			[
				'label'       => __( 'Mode Scroll', 'any-digital' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'auto'   => __( 'Auto Scroll (Otomatis)', 'any-digital' ),
					'manual' => __( 'Manual (Tekan & Tahan)', 'any-digital' ),
					'both'   => __( 'Keduanya', 'any-digital' ),
				],
				'default'     => 'auto',
				'description' => __( 'Pilih cara kerja tombol scroll', 'any-digital' ),
			]
		);

		$this->add_control(
			'scroll_direction',
			[
				'label'   => __( 'Arah Scroll', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'down' => __( 'Ke Bawah', 'any-digital' ),
					'up'   => __( 'Ke Atas', 'any-digital' ),
				],
				'default' => 'down',
			]
		);

		$this->add_control(
			'auto_start',
			[
				'label'        => __( 'Mulai Otomatis', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => __( 'Scroll dimulai otomatis saat halaman dimuat', 'any-digital' ),
				'condition'    => [
					'scroll_mode!' => 'manual',
				],
			]
		);

		$this->add_control(
			'auto_start_delay',
			[
				'label'      => __( 'Delay Mulai Otomatis (detik)', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.5,
					],
				],
				'default'    => [
					'size' => 2,
				],
				'condition'  => [
					'auto_start'   => 'yes',
					'scroll_mode!' => 'manual',
				],
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'        => __( 'Pause Saat User Scroll', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => __( 'Auto-scroll akan berhenti jika user melakukan scroll manual', 'any-digital' ),
			]
		);

		$this->add_control(
			'loop_scroll',
			[
				'label'        => __( 'Loop ke Atas', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => '',
				'description'  => __( 'Kembali ke atas setelah sampai bawah', 'any-digital' ),
				'condition'    => [
					'scroll_direction' => 'down',
				],
			]
		);

		$this->add_control(
			'disable_on_ios',
			[
				'label'        => __( 'Nonaktifkan di iOS', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => '',
				'description'  => __( 'Auto-scroll mungkin tidak optimal di iOS', 'any-digital' ),
			]
		);

		$this->end_controls_section();

		// Scroll Speed Section
		$this->start_controls_section(
			'section_speed',
			[
				'label' => __( 'Kecepatan & Gerakan', 'any-digital' ),
			]
		);

		$this->add_control(
			'smoothness',
			[
				'label'       => __( 'Tingkat Kehalusan', 'any-digital' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'ultra'  => __( 'Ultra Halus (60fps)', 'any-digital' ),
					'smooth' => __( 'Halus (30fps)', 'any-digital' ),
					'normal' => __( 'Normal', 'any-digital' ),
				],
				'default'     => 'ultra',
				'description' => __( 'Semakin halus = lebih smooth tapi butuh performa lebih', 'any-digital' ),
			]
		);

		$this->add_control(
			'scroll_speed',
			[
				'label'       => __( 'Kecepatan Scroll', 'any-digital' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'     => [
					'size' => 30,
				],
				'description' => __( 'Kecepatan default (1-100)', 'any-digital' ),
			]
		);

		$this->add_control(
			'easing_type',
			[
				'label'   => __( 'Tipe Easing', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'linear'      => __( 'Linear (Konstan)', 'any-digital' ),
					'ease'        => __( 'Ease (Smooth)', 'any-digital' ),
					'ease-in'     => __( 'Ease In (Lambat → Cepat)', 'any-digital' ),
					'ease-out'    => __( 'Ease Out (Cepat → Lambat)', 'any-digital' ),
					'ease-in-out' => __( 'Ease In-Out (Smooth Both)', 'any-digital' ),
				],
				'default' => 'linear',
			]
		);

		$this->add_control(
			'show_speed_control',
			[
				'label'        => __( 'Tampilkan Kontrol Kecepatan', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'speed_control_layout',
			[
				'label'     => __( 'Layout Kontrol', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'horizontal' => __( 'Horizontal', 'any-digital' ),
					'vertical'   => __( 'Vertikal', 'any-digital' ),
				],
				'default'   => 'vertical',
				'condition' => [
					'show_speed_control' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_control_position',
			[
				'label'       => __( 'Posisi Kontrol', 'any-digital' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'auto'   => __( 'Otomatis (di bawah tombol)', 'any-digital' ),
					'left'   => __( 'Kiri Tombol', 'any-digital' ),
					'right'  => __( 'Kanan Tombol', 'any-digital' ),
					'top'    => __( 'Atas Tombol', 'any-digital' ),
					'bottom' => __( 'Bawah Tombol', 'any-digital' ),
				],
				'default'     => 'auto',
				'description' => __( 'Posisi kontrol kecepatan relatif terhadap tombol utama', 'any-digital' ),
				'condition'   => [
					'show_speed_control' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_control_draggable',
			[
				'label'        => __( 'Bisa Digeser (Draggable)', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => '',
				'description'  => __( 'Izinkan user menggeser posisi kontrol kecepatan', 'any-digital' ),
				'condition'    => [
					'show_speed_control' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_control_label',
			[
				'label'     => __( 'Label Kontrol Kecepatan', 'any-digital' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Kecepatan', 'any-digital' ),
				'condition' => [
					'show_speed_control' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_value_animation_type',
			[
				'label'     => __( 'Animasi Nilai Kecepatan', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none'   => __( 'Tidak Ada', 'any-digital' ),
					'pulse'  => __( 'Pulse', 'any-digital' ),
					'bounce' => __( 'Bounce', 'any-digital' ),
					'slide'  => __( 'Slide', 'any-digital' ),
				],
				'default'   => 'pulse',
				'condition' => [
					'show_speed_control' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_speed_arrows',
			[
				'label'        => __( 'Tampilkan Tombol +/-', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
				'condition'    => [
					'show_speed_control' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_arrow_minus_icon',
			[
				'label'     => __( 'Icon Tombol -', 'any-digital' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-minus',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_speed_control' => 'yes',
					'show_speed_arrows'  => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_arrow_plus_icon',
			[
				'label'     => __( 'Icon Tombol +', 'any-digital' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_speed_control' => 'yes',
					'show_speed_arrows'  => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Button Section
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Tombol Utama', 'any-digital' ),
			]
		);

		$this->add_control(
			'button_icon_start',
			[
				'label'   => __( 'Icon Mulai', 'any-digital' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-arrow-down',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'button_icon_stop',
			[
				'label'   => __( 'Icon Berhenti', 'any-digital' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-pause',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'button_position',
			[
				'label'   => __( 'Posisi', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'bottom-right' => __( 'Kanan Bawah', 'any-digital' ),
					'bottom-left'  => __( 'Kiri Bawah', 'any-digital' ),
					'bottom-center' => __( 'Tengah Bawah', 'any-digital' ),
					'right-center' => __( 'Kanan Tengah', 'any-digital' ),
					'left-center'  => __( 'Kiri Tengah', 'any-digital' ),
				],
				'default' => 'bottom-right',
			]
		);

		$this->add_control(
			'widget_position_horizontal',
			[
				'label'   => __( 'Posisi Horizontal (Lanjutan)', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''       => __( 'Gunakan Posisi Utama', 'any-digital' ),
					'left'   => __( 'Kiri', 'any-digital' ),
					'center' => __( 'Tengah', 'any-digital' ),
					'right'  => __( 'Kanan', 'any-digital' ),
				],
				'default' => '',
				'description' => __( 'Override posisi horizontal. Kosongkan untuk mengikuti Posisi utama.', 'any-digital' ),
			]
		);

		$this->add_control(
			'widget_position_vertical',
			[
				'label'   => __( 'Posisi Vertikal (Lanjutan)', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''       => __( 'Gunakan Posisi Utama', 'any-digital' ),
					'top'    => __( 'Atas', 'any-digital' ),
					'center' => __( 'Tengah', 'any-digital' ),
					'bottom' => __( 'Bawah', 'any-digital' ),
				],
				'default' => '',
				'description' => __( 'Override posisi vertikal. Kosongkan untuk mengikuti Posisi utama.', 'any-digital' ),
			]
		);

		$this->add_control(
			'button_appear_animation',
			[
				'label'     => __( 'Animasi Muncul', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none'    => __( 'Tidak Ada', 'any-digital' ),
					'fade'    => __( 'Fade', 'any-digital' ),
					'slide'   => __( 'Slide', 'any-digital' ),
					'scale'   => __( 'Scale', 'any-digital' ),
					'bounce'  => __( 'Bounce', 'any-digital' ),
					'zoom'    => __( 'Zoom', 'any-digital' ),
					'flip'    => __( 'Flip', 'any-digital' ),
					'elastic' => __( 'Elastic', 'any-digital' ),
				],
				'default'   => 'fade',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_appear_animation_duration',
			[
				'label'     => __( 'Durasi Animasi Muncul (detik)', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [ 'min' => 0.1, 'max' => 2, 'step' => 0.1 ],
				],
				'default'   => [ 'size' => 0.5 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-btn-container' => '--ak-button-appear-duration: {{SIZE}}s;',
				],
				'condition' => [
					'button_appear_animation!' => 'none',
				],
			]
		);

		$this->add_control(
			'button_appear_animation_delay',
			[
				'label'     => __( 'Delay Animasi Muncul (detik)', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [ 'min' => 0, 'max' => 5, 'step' => 0.1 ],
				],
				'default'   => [ 'size' => 0 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-btn-container' => '--ak-button-appear-delay: {{SIZE}}s;',
				],
				'condition' => [
					'button_appear_animation!' => 'none',
				],
			]
		);


		$this->add_responsive_control(
			'button_offset_x',
			[
				'label'      => __( 'Offset Horizontal', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 200 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
					'vw' => [ 'min' => 0, 'max' => 20 ],
				],
				'default'    => [ 'size' => 25, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap.pos-bottom-right, {{WRAPPER}} .apeiron-autoscroll-wrap.pos-right-center' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap.pos-bottom-left, {{WRAPPER}} .apeiron-autoscroll-wrap.pos-left-center' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'button_position!' => 'bottom-center',
				],
			]
		);

		$this->add_responsive_control(
			'button_offset_y',
			[
				'label'      => __( 'Offset Vertikal', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 300 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
					'vh' => [ 'min' => 0, 'max' => 30 ],
				],
				'default'    => [ 'size' => 100, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap.pos-bottom-right, {{WRAPPER}} .apeiron-autoscroll-wrap.pos-bottom-left, {{WRAPPER}} .apeiron-autoscroll-wrap.pos-bottom-center' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap.pos-right-center, {{WRAPPER}} .apeiron-autoscroll-wrap.pos-left-center' => 'top: calc(50% + {{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_section();

		// Tooltip Section
		$this->start_controls_section(
			'section_tooltip',
			[
				'label' => __( 'Tooltip & Notifikasi', 'any-digital' ),
			]
		);

		$this->add_control(
			'show_tooltip',
			[
				'label'        => __( 'Tampilkan Tooltip', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'tooltip_text_start',
			[
				'label'     => __( 'Teks Mulai', 'any-digital' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Mulai Auto Scroll', 'any-digital' ),
				'condition' => [ 'show_tooltip' => 'yes' ],
			]
		);

		$this->add_control(
			'tooltip_text_stop',
			[
				'label'     => __( 'Teks Berhenti', 'any-digital' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Berhenti Scroll', 'any-digital' ),
				'condition' => [ 'show_tooltip' => 'yes' ],
			]
		);

		$this->add_control(
			'show_end_notification',
			[
				'label'        => __( 'Notifikasi Akhir Halaman', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'end_notification_text',
			[
				'label'     => __( 'Teks Notifikasi Akhir', 'any-digital' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Anda sudah di akhir halaman!', 'any-digital' ),
				'condition' => [ 'show_end_notification' => 'yes' ],
			]
		);

		$this->end_controls_section();

		// Progress Indicator Section
		$this->start_controls_section(
			'section_progress',
			[
				'label' => __( 'Progress Indicator', 'any-digital' ),
			]
		);

		$this->add_control(
			'show_progress',
			[
				'label'        => __( 'Tampilkan Progress', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'progress_type',
			[
				'label'     => __( 'Tipe Progress', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'circle' => __( 'Circle (Melingkar)', 'any-digital' ),
					'bar'    => __( 'Bar (Garis)', 'any-digital' ),
				],
				'default'   => 'circle',
				'condition' => [ 'show_progress' => 'yes' ],
			]
		);

		$this->end_controls_section();

		// Scroll to Top Button Section
		$this->start_controls_section(
			'section_scroll_top',
			[
				'label' => __( 'Tombol Scroll ke Atas', 'any-digital' ),
			]
		);

		$this->add_control(
			'show_scroll_top',
			[
				'label'        => __( 'Tampilkan Tombol', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'scroll_top_icon',
			[
				'label'     => __( 'Icon', 'any-digital' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-chevron-up',
					'library' => 'fa-solid',
				],
				'condition' => [ 'show_scroll_top' => 'yes' ],
			]
		);

		$this->add_control(
			'scroll_top_show_after',
			[
				'label'       => __( 'Tampilkan Setelah Scroll (%)', 'any-digital' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [ 'min' => 5, 'max' => 50, 'step' => 5 ],
				],
				'default'     => [ 'size' => 20 ],
				'description' => __( 'Tombol muncul setelah user scroll sekian persen dari halaman', 'any-digital' ),
				'condition'   => [ 'show_scroll_top' => 'yes' ],
			]
		);

		$this->end_controls_section();


		// ==================== STYLE TAB ====================

		// Container Style
		$this->start_controls_section(
			'section_style_container',
			[
				'label' => __( 'Kontainer Widget', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'container_background',
				'selector' => '{{WRAPPER}} .apeiron-autoscroll-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'container_border',
				'selector' => '{{WRAPPER}} .apeiron-autoscroll-wrap',
			]
		);

		$this->add_responsive_control(
			'container_radius',
			[
				'label'      => __( 'Radius', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'container_shadow',
				'selector' => '{{WRAPPER}} .apeiron-autoscroll-wrap',
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[
				'label'      => __( 'Padding', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'container_opacity',
			[
				'label'     => __( 'Opacity', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.05,
					],
				],
				'default'   => [ 'size' => 1 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

		// Button Style Section
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Tombol Utama', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_size',
			[
				'label'      => __( 'Ukuran', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 24, 'max' => 120 ] ],
				'default'    => [ 'size' => 38, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_icon_size',
			[
				'label'      => __( 'Ukuran Icon', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 10, 'max' => 80 ] ],
				'default'    => [ 'size' => 12, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-btn i, {{WRAPPER}} .apeiron-scroll-btn svg' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		// Normal State
		$this->start_controls_tab( 'tab_button_normal', [ 'label' => __( 'Normal', 'any-digital' ) ] );

		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Warna Icon', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .apeiron-scroll-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-scroll-btn svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'button_background',
				'selector'       => '{{WRAPPER}} .apeiron-scroll-btn',
				'fields_options' => [
					'background' => [ 'default' => 'classic' ],
					'color'      => [ 'default' => '#083c57' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .apeiron-scroll-btn',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'size' => 50, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .apeiron-scroll-btn',
			]
		);

		$this->end_controls_tab();

		// Hover State
		$this->start_controls_tab( 'tab_button_hover', [ 'label' => __( 'Hover', 'any-digital' ) ] );

		$this->add_control(
			'button_hover_color',
			[
				'label'     => __( 'Warna Icon', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apeiron-scroll-btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-scroll-btn:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_hover_background',
				'selector' => '{{WRAPPER}} .apeiron-scroll-btn:hover',
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apeiron-scroll-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .apeiron-scroll-btn:hover',
			]
		);

		$this->add_control(
			'button_hover_scale',
			[
				'label'      => __( 'Scale', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0.8, 'max' => 1.5, 'step' => 0.05 ] ],
				'default'    => [ 'size' => 1.05 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-btn:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->end_controls_tab();

		// Active State
		$this->start_controls_tab( 'tab_button_active', [ 'label' => __( 'Active', 'any-digital' ) ] );

		$this->add_control(
			'button_active_color',
			[
				'label'     => __( 'Warna Icon', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .apeiron-scroll-btn.is-active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-scroll-btn.is-active svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'button_active_background',
				'selector'       => '{{WRAPPER}} .apeiron-scroll-btn.is-active',
				'fields_options' => [
					'background' => [ 'default' => 'classic' ],
					'color'      => [ 'default' => '#083c57' ],
				],
			]
		);

		$this->add_control(
			'button_active_animation',
			[
				'label'   => __( 'Animasi Active', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'             => __( 'Tidak Ada', 'any-digital' ),
					'pulse-soft'       => __( 'Pulse Soft', 'any-digital' ),
					'scale-breathing'  => __( 'Scale Breathing', 'any-digital' ),
					'micro-bounce'     => __( 'Micro Bounce', 'any-digital' ),
					'smooth-rotate'    => __( 'Smooth Rotate', 'any-digital' ),
					'glow-ring'        => __( 'Glow Ring Subtle', 'any-digital' ),
					'orbit-ring'       => __( 'Orbit Ring', 'any-digital' ),
					'ripple-wave'      => __( 'Ripple Wave', 'any-digital' ),
				],
				'default' => 'pulse-soft',
			]
		);

		$this->add_control(
			'button_active_anim_speed',
			[
				'label'     => __( 'Kecepatan Animasi', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 0.5, 'max' => 3, 'step' => 0.1 ] ],
				'default'   => [ 'size' => 1.5 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-active-anim-speed: {{SIZE}}s;',
				],
				'condition' => [ 'button_active_animation!' => 'none' ],
			]
		);

		$this->add_control(
			'button_active_anim_color',
			[
				'label'     => __( 'Warna Animasi', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(8,60,87,0.3)',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-active-anim-color: {{VALUE}};',
				],
				'condition' => [
					'button_active_animation' => [ 'glow-ring', 'orbit-ring', 'ripple-wave' ],
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'button_transition',
			[
				'label'      => __( 'Durasi Transisi', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'separator'  => 'before',
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.05 ] ],
				'default'    => [ 'size' => 0.3 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-btn' => 'transition: all {{SIZE}}s cubic-bezier(0.4, 0, 0.2, 1);',
				],
			]
		);

		$this->end_controls_section();

		// Ripple Effect Section
		$this->start_controls_section(
			'section_style_ripple',
			[
				'label' => __( 'Efek Ripple', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ripple_enable',
			[
				'label'        => __( 'Aktifkan Ripple', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'ripple_color',
			[
				'label'     => __( 'Warna Ripple', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(8,60,87,0.3)',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-ripple-color: {{VALUE}};',
				],
				'condition' => [ 'ripple_enable' => 'yes' ],
			]
		);

		$this->add_control(
			'ripple_size',
			[
				'label'     => __( 'Ukuran Ripple', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 120, 'max' => 300 ] ],
				'default'   => [ 'size' => 180 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-ripple-size: {{SIZE}};',
				],
				'condition' => [ 'ripple_enable' => 'yes' ],
			]
		);

		$this->add_control(
			'ripple_thickness',
			[
				'label'     => __( 'Ketebalan Ripple', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 1, 'max' => 6 ] ],
				'default'   => [ 'size' => 2 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-ripple-thickness: {{SIZE}}px;',
				],
				'condition' => [ 'ripple_enable' => 'yes' ],
			]
		);

		$this->add_control(
			'ripple_speed',
			[
				'label'     => __( 'Kecepatan Ripple', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 0.5, 'max' => 3, 'step' => 0.1 ] ],
				'default'   => [ 'size' => 1.5 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-ripple-speed: {{SIZE}}s;',
				],
				'condition' => [ 'ripple_enable' => 'yes' ],
			]
		);

		$this->add_control(
			'ripple_opacity',
			[
				'label'     => __( 'Opacity Ripple', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.05 ] ],
				'default'   => [ 'size' => 0.6 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-ripple-opacity: {{SIZE}};',
				],
				'condition' => [ 'ripple_enable' => 'yes' ],
			]
		);

		$this->add_control(
			'ripple_mode',
			[
				'label'     => __( 'Mode Ripple', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'infinite',
				'options'   => [
					'single'   => __( 'Single Wave', 'any-digital' ),
					'infinite' => __( 'Infinite Pulse', 'any-digital' ),
					'double'   => __( 'Double Wave', 'any-digital' ),
				],
				'condition' => [ 'ripple_enable' => 'yes' ],
			]
		);

		$this->end_controls_section();

		// Progress Style Section
		$this->start_controls_section(
			'section_style_progress',
			[
				'label'     => __( 'Progress', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_progress' => 'yes' ],
			]
		);

		$this->add_control(
			'progress_color',
			[
				'label'     => __( 'Warna Progress', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#083c57',
				'selectors' => [
					'{{WRAPPER}} .apeiron-progress-ring circle.progress' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .apeiron-progress-bar .bar-fill' => 'background: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-progress-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'progress_bg_color',
			[
				'label'     => __( 'Warna Background', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(8,60,87,0.2)',
				'selectors' => [
					'{{WRAPPER}} .apeiron-progress-ring circle.track' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .apeiron-progress-bar' => 'background: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-progress-bg-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'progress_stroke_width',
			[
				'label'      => __( 'Ketebalan', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 2, 'max' => 10 ] ],
				'default'    => [ 'size' => 3 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-progress-ring circle' => 'stroke-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-progress-stroke-width: {{SIZE}};',
					'{{WRAPPER}} .apeiron-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-progress-bar .bar-fill' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'progress_indicator_size',
			[
				'label'       => __( 'Ukuran Progress Indicator', 'any-digital' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px' => [ 'min' => 30, 'max' => 150 ],
					'%'  => [ 'min' => 100, 'max' => 300 ],
				],
				'selectors'   => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-progress-ring-size: {{SIZE}}{{UNIT}};',
				],
				'description' => __( 'Mengatur ukuran keseluruhan progress indicator. Kosongkan untuk mengikuti ukuran tombol otomatis.', 'any-digital' ),
				'condition'   => [
					'show_progress' => 'yes',
					'progress_type' => 'circle',
				],
			]
		);

		$this->add_control(
			'progress_stroke_cap',
			[
				'label'     => __( 'Stroke Cap', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'round',
				'options'   => [
					'round'  => __( 'Round', 'any-digital' ),
					'square' => __( 'Square', 'any-digital' ),
				],
				'selectors' => [
					'{{WRAPPER}} .apeiron-progress-ring .progress' => 'stroke-linecap: {{VALUE}};',
				],
				'condition' => [
					'show_progress' => 'yes',
					'progress_type' => 'circle',
				],
			]
		);

		$this->add_control(
			'progress_animation_type',
			[
				'label'     => __( 'Animasi Progress', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => [
					'none'            => __( 'Tidak Ada', 'any-digital' ),
					'linear-clean'    => __( 'Linear Clean', 'any-digital' ),
					'smooth-fill'     => __( 'Smooth Fill', 'any-digital' ),
					'wave-stroke'     => __( 'Wave Stroke', 'any-digital' ),
					'rotating-stroke' => __( 'Rotating Stroke', 'any-digital' ),
					'elastic-stroke'  => __( 'Elastic Stroke', 'any-digital' ),
				],
				'separator'  => 'before',
				'condition'  => [
					'show_progress' => 'yes',
					'progress_type' => 'circle',
				],
			]
		);

		$this->add_responsive_control(
			'progress_animation_speed',
			[
				'label'      => __( 'Kecepatan Animasi', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [ 'min' => 0.5, 'max' => 5, 'step' => 0.1 ],
				],
				'default'    => [ 'size' => 1.5 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-progress-animation-speed: {{SIZE}}s;',
				],
				'condition'  => [
					'show_progress'           => 'yes',
					'progress_type'           => 'circle',
					'progress_animation_type!' => 'none',
				],
			]
		);

		$this->end_controls_section();

		// Tooltip Style Section
		$this->start_controls_section(
			'section_style_tooltip',
			[
				'label'     => __( 'Tooltip', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_tooltip' => 'yes' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tooltip_typography',
				'selector' => '{{WRAPPER}} .apeiron-scroll-tooltip',
			]
		);

		$this->add_control(
			'tooltip_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .apeiron-scroll-tooltip' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltip_bg_color',
			[
				'label'     => __( 'Background', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(15, 23, 42, 0.9)',
				'selectors' => [
					'{{WRAPPER}} .apeiron-scroll-tooltip' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[
				'label'      => __( 'Padding', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'    => 8,
					'right'  => 14,
					'bottom' => 8,
					'left'   => 14,
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 20 ] ],
				'default'    => [ 'size' => 8, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-tooltip' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// End Notification Style Section
		$this->start_controls_section(
			'section_style_end_notification',
			[
				'label'     => __( 'Notifikasi Akhir Halaman', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_end_notification' => 'yes' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'end_notification_typography',
				'selector' => '{{WRAPPER}} .apeiron-end-notification',
			]
		);

		$this->add_control(
			'end_notification_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .apeiron-end-notification' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'end_notification_bg_color',
			[
				'label'     => __( 'Background', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(8, 60, 87, 0.9)',
				'selectors' => [
					'{{WRAPPER}} .apeiron-end-notification' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'end_notification_padding',
			[
				'label'      => __( 'Padding', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'    => '8',
					'right'  => '14',
					'bottom' => '8',
					'left'   => '14',
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-end-notification' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'end_notification_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 30 ], '%' => [ 'min' => 0, 'max' => 100 ] ],
				'default'    => [ 'size' => 8, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-end-notification' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'end_notification_shadow',
				'selector' => '{{WRAPPER}} .apeiron-end-notification',
			]
		);

		$this->add_control(
			'end_notification_animation',
			[
				'label'   => __( 'Animasi Muncul', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'fade'    => __( 'Fade', 'any-digital' ),
					'slide'   => __( 'Slide', 'any-digital' ),
					'scale'   => __( 'Scale', 'any-digital' ),
					'bounce'  => __( 'Bounce', 'any-digital' ),
					'zoom'    => __( 'Zoom', 'any-digital' ),
					'flip'    => __( 'Flip', 'any-digital' ),
				],
				'default' => 'fade',
			]
		);

		$this->add_control(
			'end_notification_animation_duration',
			[
				'label'      => __( 'Durasi Animasi (detik)', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0.1, 'max' => 2, 'step' => 0.1 ] ],
				'default'    => [ 'size' => 0.5 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-end-notification' => '--ak-end-notification-duration: {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_section();

		// ============================================================
		// SECTION 1: Kontrol Slider (Container)
		// ============================================================
		$this->start_controls_section(
			'section_style_speed_container',
			[
				'label'     => __( 'Kontrol Slider', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_speed_control' => 'yes' ],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'speed_control_bg',
				'selector'       => '{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control',
				'fields_options' => [
					'background' => [ 'default' => 'classic' ],
					'color'      => [ 'default' => '#ffffff' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'speed_control_shadow',
				'selector' => '{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'speed_control_border',
				'selector'       => '{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control',
				'fields_options' => [
					'border' => [ 'default' => 'solid' ],
					'width'  => [
						'default' => [
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
							'unit'   => 'px',
						],
					],
					'color'  => [ 'default' => '#083C572E' ],
				],
			]
		);

		$this->add_responsive_control(
			'speed_control_padding',
			[
				'label'      => __( 'Padding', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'    => 9,
					'right'  => 4,
					'bottom' => 8,
					'left'   => 4,
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'speed_control_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 30 ] ],
				'default'    => [ 'size' => 30 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'speed_control_gap',
			[
				'label'      => __( 'Jarak ke Tombol Utama', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
				'default'    => [ 'size' => 20, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_speed_animation',
			[
				'label'     => __( 'Animasi', 'any-digital' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'speed_control_show_animation',
			[
				'label'        => __( 'Tampilkan Animasi', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'speed_control_appear_animation',
			[
				'label'   => __( 'Animasi Muncul', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'fade'       => __( 'Fade', 'any-digital' ),
					'slide'      => __( 'Slide', 'any-digital' ),
					'scale'      => __( 'Scale', 'any-digital' ),
					'bounce'     => __( 'Bounce', 'any-digital' ),
					'zoom'       => __( 'Zoom', 'any-digital' ),
					'flip'       => __( 'Flip', 'any-digital' ),
					'elastic'    => __( 'Elastic', 'any-digital' ),
					'slide-up'   => __( 'Slide Up', 'any-digital' ),
					'slide-down' => __( 'Slide Down', 'any-digital' ),
				],
				'default'   => 'scale',
				'condition' => [
					'speed_control_show_animation' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_control_disappear_animation',
			[
				'label'   => __( 'Animasi Keluar', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'fade'       => __( 'Fade', 'any-digital' ),
					'slide'      => __( 'Slide', 'any-digital' ),
					'scale'      => __( 'Scale', 'any-digital' ),
					'bounce'     => __( 'Bounce', 'any-digital' ),
					'zoom'       => __( 'Zoom', 'any-digital' ),
					'flip'       => __( 'Flip', 'any-digital' ),
					'elastic'    => __( 'Elastic', 'any-digital' ),
					'slide-up'   => __( 'Slide Up', 'any-digital' ),
					'slide-down' => __( 'Slide Down', 'any-digital' ),
				],
				'default'   => 'scale',
				'condition' => [
					'speed_control_show_animation' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_control_animation_duration',
			[
				'label'     => __( 'Durasi Animasi (detik)', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 0.1, 'max' => 2, 'step' => 0.1 ] ],
				'default'   => [ 'size' => 0.4 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-control-animation-duration: {{SIZE}}s;',
				],
				'condition' => [
					'speed_control_show_animation' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// ============================================================
		// SECTION 2: Slider Kecepatan
		// ============================================================
		$this->start_controls_section(
			'section_style_speed_slider',
			[
				'label'     => __( 'Slider Kecepatan', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_speed_control' => 'yes' ],
			]
		);

		$this->add_control(
			'speed_slider_color',
			[
				'label'     => __( 'Warna Utama Slider', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#083c57',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-slider-thumb: {{VALUE}}; --ak-slider-track-active: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-webkit-slider-thumb' => 'background: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-moz-range-thumb' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'speed_slider_track_color',
			[
				'label'     => __( 'Warna Track', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2e8f0',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-slider-track: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-moz-range-track' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'speed_slider_width',
			[
				'label'     => __( 'Panjang Slider', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 40, 'max' => 150 ] ],
				'default'   => [ 'size' => 74 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control.layout-horizontal .apeiron-speed-slider' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control.layout-vertical .apeiron-speed-slider' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'speed_slider_track_height',
			[
				'label'       => __( 'Ketebalan Track', 'any-digital' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [ 'px' => [ 'min' => 2, 'max' => 12 ] ],
				'default'     => [ 'size' => 5 ],
				'selectors'   => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-slider-track-height: {{SIZE}}{{UNIT}};',
				],
				'description' => __( 'Mengatur ketebalan garis track slider', 'any-digital' ),
			]
		);

		$this->add_control(
			'speed_slider_track_radius',
			[
				'label'       => __( 'Radius Track', 'any-digital' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [ 'px' => [ 'min' => 0, 'max' => 20 ] ],
				'default'     => [ 'size' => 20 ],
				'selectors'   => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-slider-track-radius: {{SIZE}}{{UNIT}};',
				],
				'description' => __( 'Mengatur kebulatan ujung track slider', 'any-digital' ),
			]
		);

		$this->end_controls_section();

		// ============================================================
		// SECTION 2b: Thumb Slider
		// ============================================================
		$this->start_controls_section(
			'section_style_speed_thumb',
			[
				'label'     => __( 'Thumb Slider', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_speed_control' => 'yes' ],
			]
		);

		$this->add_control(
			'speed_slider_thumb_size',
			[
				'label'      => __( 'Ukuran Thumb', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 10, 'max' => 30 ] ],
				'default'    => [ 'size' => 18 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-slider-thumb-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-webkit-slider-thumb' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-moz-range-thumb' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'speed_slider_thumb_radius',
			[
				'label'      => __( 'Radius Thumb', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ], '%' => [ 'min' => 0, 'max' => 100 ] ],
				'default'    => [ 'size' => 50, 'unit' => '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-slider-thumb-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-webkit-slider-thumb' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-moz-range-thumb' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'speed_slider_thumb_border_width',
			[
				'label'      => __( 'Border Thumb (px)', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 5, 'step' => 1 ] ],
				'default'    => [ 'size' => 0 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-slider-thumb-border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-webkit-slider-thumb' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-moz-range-thumb' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
				],
			]
		);

		$this->add_control(
			'speed_slider_thumb_border_color',
			[
				'label'     => __( 'Warna Border Thumb', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,0.9)',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-slider-thumb-border-color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-webkit-slider-thumb' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-slider::-moz-range-thumb' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// ============================================================
		// SECTION 3: Tombol Tambah / Kurang
		// ============================================================
		$this->start_controls_section(
			'section_style_speed_arrows',
			[
				'label'     => __( 'Tombol Tambah / Kurang', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_speed_control' => 'yes',
					'show_speed_arrows'  => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'speed_control_elements_gap',
			[
				'label'       => __( 'Jarak Antar Elemen', 'any-digital' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', 'em' ],
				'range'       => [
					'px' => [ 'min' => 0, 'max' => 20 ],
					'em' => [ 'min' => 0, 'max' => 2, 'step' => 0.1 ],
				],
				'default'     => [ 'size' => 4, 'unit' => 'px' ],
				'selectors'   => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-inner' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrows' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'description' => __( 'Mengatur jarak antara tombol +, angka, dan tombol -', 'any-digital' ),
			]
		);

		$this->add_responsive_control(
			'speed_count_arrows_gap',
			[
				'label'      => __( 'Jarak Count ke Tombol +/-', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
				'default'    => [ 'size' => 12, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control.layout-horizontal' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control.layout-vertical' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_speed_arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed_arrow_color',
			[
				'label'     => __( 'Warna Icon', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#083c57',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow svg' => 'stroke: {{VALUE}} !important; fill: {{VALUE}} !important;',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow i::before' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'speed_arrow_bg',
			[
				'label'     => __( 'Background', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f1f5f9',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-bg: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'speed_arrow_hover_bg',
			[
				'label'     => __( 'Background Hover', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#083c57',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-hover-bg: {{VALUE}}; --ak-speed-arrow-active-bg: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'speed_arrow_hover_color',
			[
				'label'     => __( 'Warna Icon Hover', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-hover-color: {{VALUE}}; --ak-speed-arrow-active-color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow:hover svg' => 'stroke: {{VALUE}} !important; fill: {{VALUE}} !important; color: {{VALUE}} !important;',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow:hover i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow:hover i::before' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'speed_arrow_size',
			[
				'label'      => __( 'Ukuran Tombol', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 20, 'max' => 50 ] ],
				'default'    => [ 'size' => 28 ],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'speed_arrow_icon_size',
			[
				'label'      => __( 'Ukuran Icon', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 8, 'max' => 32 ] ],
				'default'    => [ 'size' => 10 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-icon-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'speed_arrow_radius',
			[
				'label'     => __( 'Radius Tombol', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 0, 'max' => 24 ] ],
				'default'   => [ 'size' => 24 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'speed_arrow_padding',
			[
				'label'      => __( 'Padding Tombol', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'speed_arrow_border',
				'selector' => '{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'speed_arrow_shadow',
				'selector' => '{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow',
			]
		);

		$this->add_control(
			'speed_arrow_opacity',
			[
				'label'     => __( 'Opacity Tombol', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 0.1, 'max' => 1, 'step' => 0.05 ] ],
				'default'   => [ 'size' => 1 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-arrow-opacity: {{SIZE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-arrow' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

		// ============================================================
		// SECTION 4: Angka Counter
		// ============================================================
		$this->start_controls_section(
			'section_style_speed_label',
			[
				'label'     => __( 'Angka Counter', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_speed_control' => 'yes' ],
			]
		);

		$this->add_control(
			'speed_label_color',
			[
				'label'     => __( 'Warna Angka', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#083c57',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-value-color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'speed_label_bg_color',
			[
				'label'     => __( 'Background Angka', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e8f0f4',
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-speed-value-bg: {{VALUE}};',
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-value' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'speed_counter_size',
			[
				'label'      => __( 'Ukuran Counter', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 20, 'max' => 60 ] ],
				'default'    => [ 'size' => 26 ],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-value' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'speed_label_size',
			[
				'label'     => __( 'Ukuran Font', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 'px' => [ 'min' => 8, 'max' => 20 ] ],
				'default'   => [ 'size' => 9 ],
				'selectors' => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-value' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'speed_counter_radius',
			[
				'label'      => __( 'Radius Counter', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 30 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'size' => 23, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-value' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'speed_counter_padding',
			[
				'label'      => __( 'Padding Counter', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'    => 5,
					'right'  => 5,
					'bottom' => 5,
					'left'   => 5,
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'speed_counter_border',
				'selector' => '{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-value',
			]
		);

		$this->add_responsive_control(
			'speed_counter_margin',
			[
				'label'      => __( 'Margin Counter', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap .apeiron-speed-control .speed-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Scroll Top Button Style Section
		$this->start_controls_section(
			'section_style_scroll_top',
			[
				'label'     => __( 'Tombol Scroll Atas', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_scroll_top' => 'yes' ],
			]
		);

		$this->add_responsive_control(
			'scroll_top_size',
			[
				'label'      => __( 'Ukuran Bulatan', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 30, 'max' => 60 ] ],
				'default'    => [ 'size' => 30 ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-top-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_top_icon_size',
			[
				'label'      => __( 'Ukuran Icon', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 8, 'max' => 80, 'step' => 1 ] ],
				'default'    => [ 'size' => 12, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-scroll-top-icon-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn' => 'font-size: {{SIZE}}{{UNIT}}; --ak-scroll-top-icon-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; max-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: 1;',
					'{{WRAPPER}} .apeiron-scroll-top-btn i::before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn > *' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_top_icon_padding',
			[
				'label'      => __( 'Padding Icon', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 30,
						'step' => 1,
					],
				],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-scroll-top-icon-padding-top: {{TOP}}{{UNIT}}; --ak-scroll-top-icon-padding-right: {{RIGHT}}{{UNIT}}; --ak-scroll-top-icon-padding-bottom: {{BOTTOM}}{{UNIT}}; --ak-scroll-top-icon-padding-left: {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn > *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'scroll_top_color',
			[
				'label'     => __( 'Warna Icon', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .apeiron-scroll-top-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn svg' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_top_bg',
			[
				'label'     => __( 'Background', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#083c57',
				'selectors' => [
					'{{WRAPPER}} .apeiron-scroll-top-btn' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_top_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 30 ], '%' => [ 'min' => 0, 'max' => 100 ] ],
				'default'    => [ 'size' => 68, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-scroll-top-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_top_gap',
			[
				'label'      => __( 'Jarak dari Progress', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
				'default'    => [ 'size' => 0, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .apeiron-autoscroll-wrap' => '--ak-scroll-top-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apeiron-scroll-top-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		parent::render(); // Layer 2: disabled gate + license gate
		if ( $this->is_widget_disabled() ) {
			return; // Widget disabled via dashboard toggle — output nothing
		}
		

		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		// Get icon HTML
		ob_start();
		Icons_Manager::render_icon( $settings['button_icon_start'], [ 'aria-hidden' => 'true' ] );
		$icon_start = ob_get_clean();

		ob_start();
		Icons_Manager::render_icon( $settings['button_icon_stop'], [ 'aria-hidden' => 'true' ] );
		$icon_stop = ob_get_clean();

		ob_start();
		if ( ! empty( $settings['scroll_top_icon']['value'] ) ) {
			Icons_Manager::render_icon( $settings['scroll_top_icon'], [ 'aria-hidden' => 'true' ] );
		} else {
			echo '<i class="fas fa-chevron-up"></i>';
		}
		$icon_scroll_top = ob_get_clean();

		// Get speed arrow icons with simple fallback (no forced inline styles)
		$icon_minus = '';
		$icon_plus  = '';

		if ( ! empty( $settings['speed_arrow_minus_icon']['value'] ) ) {
			ob_start();
			Icons_Manager::render_icon( $settings['speed_arrow_minus_icon'], [ 'aria-hidden' => 'true' ] );
			$icon_minus = ob_get_clean();
		}

		if ( ! empty( $settings['speed_arrow_plus_icon']['value'] ) ) {
			ob_start();
			Icons_Manager::render_icon( $settings['speed_arrow_plus_icon'], [ 'aria-hidden' => 'true' ] );
			$icon_plus = ob_get_clean();
		}

		if ( empty( trim( $icon_minus ) ) ) {
			$icon_minus = '<svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12" /></svg>';
		}

		if ( empty( trim( $icon_plus ) ) ) {
			$icon_plus = '<svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>';
		}

		// Data attributes
		$data = [
			'mode'               => $settings['scroll_mode'],
			'direction'          => $settings['scroll_direction'],
			'speed'              => $settings['scroll_speed']['size'] ?? 30,
			'smoothness'         => $settings['smoothness'],
			'easing'             => $settings['easing_type'],
			'autoStart'          => $settings['auto_start'] === 'yes',
			'autoStartDelay'     => ( $settings['auto_start_delay']['size'] ?? 2 ) * 1000,
			'pauseOnInteraction' => $settings['pause_on_interaction'] === 'yes',
			'loopScroll'         => $settings['loop_scroll'] === 'yes',
			'disableOnIOS'       => $settings['disable_on_ios'] === 'yes',
			'showSpeedControl'   => $settings['show_speed_control'] === 'yes',
			'speedLayout'        => $settings['speed_control_layout'] ?? 'vertical',
			'speedPosition'      => $settings['speed_control_position'] ?? 'auto',
			'speedDraggable'     => $settings['speed_control_draggable'] === 'yes',
			'showTooltip'        => $settings['show_tooltip'] === 'yes',
			'showProgress'       => $settings['show_progress'] === 'yes',
			'progressType'       => $settings['progress_type'] ?? 'circle',
			'showScrollTop'      => $settings['show_scroll_top'] === 'yes',
			'scrollTopShowAfter' => ( $settings['scroll_top_show_after']['size'] ?? 20 ) / 100,
			'showEndNotification' => $settings['show_end_notification'] === 'yes',
			'tooltipStart'       => $settings['tooltip_text_start'] ?? __( 'Mulai Auto Scroll', 'any-digital' ),
			'tooltipStop'        => $settings['tooltip_text_stop'] ?? __( 'Berhenti Scroll', 'any-digital' ),
			'endNotificationText' => $settings['end_notification_text'] ?? __( 'Anda sudah di akhir halaman!', 'any-digital' ),
			'iconStart'          => $icon_start,
			'iconStop'           => $icon_stop,
			'iconScrollTop'      => $icon_scroll_top,
			'activeAnimation'    => $settings['button_active_animation'] ?? 'pulse-soft',
			'speedValueAnimation' => $settings['speed_value_animation_type'] ?? 'pulse',
			'buttonAppearAnimation' => $settings['button_appear_animation'] ?? 'fade',
			'buttonAppearDuration' => ( $settings['button_appear_animation_duration']['size'] ?? 0.5 ) * 1000,
			'buttonAppearDelay' => ( $settings['button_appear_animation_delay']['size'] ?? 0 ) * 1000,
			'endNotificationAnimation' => $settings['end_notification_animation'] ?? 'fade',
			'speedControlShowAnimation' => $settings['speed_control_show_animation'] ?? 'yes',
			'speedControlAppearAnimation' => $settings['speed_control_appear_animation'] ?? 'scale',
			'speedControlDisappearAnimation' => $settings['speed_control_disappear_animation'] ?? 'scale',
			'speedControlAnimationDuration' => ( $settings['speed_control_animation_duration']['size'] ?? 0.4 ) * 1000,
			'progressAnimation'  => $settings['progress_animation_type'] ?? 'none',
			'rippleEnabled'      => $settings['ripple_enable'] === 'yes',
		];



		// Get widget position from Style tab or fallback to Content tab
		$widget_pos_h = $settings['widget_position_horizontal'] ?? null;
		$widget_pos_v = $settings['widget_position_vertical'] ?? null;
		
		// Build position class based on Style tab settings
		if ( ! empty( $widget_pos_h ) && ! empty( $widget_pos_v ) ) {
			$position_class = 'pos-' . $widget_pos_v . '-' . $widget_pos_h;
		} else {
			// Fallback to Content tab button_position
			$position_class = 'pos-' . ( $settings['button_position'] ?? 'bottom-right' );
		}
		?>

		<div class="apeiron-autoscroll-wrap <?php echo esc_attr( $position_class ); ?>" 
		     id="apeiron-autoscroll-<?php echo esc_attr( $widget_id ); ?>"
		     data-config="<?php echo esc_attr( wp_json_encode( $data ) ); ?>">

			<!-- Button Container with Progress -->
			<div class="apeiron-btn-container">
				<!-- Progress Circle (inside button container for proper centering) -->
				<?php if ( $settings['show_progress'] === 'yes' && $settings['progress_type'] === 'circle' ) : ?>
					<svg class="apeiron-progress-ring" viewBox="0 0 44 44">
						<circle class="track" cx="22" cy="22" r="20" fill="none" />
						<circle class="progress" cx="22" cy="22" r="20" fill="none" stroke-dasharray="125.6" stroke-dashoffset="125.6" />
					</svg>
				<?php endif; ?>

				<!-- Main Button -->
				<button class="apeiron-scroll-btn" type="button" aria-label="<?php esc_attr_e( 'Auto Scroll', 'any-digital' ); ?>" aria-pressed="false">
					<span class="btn-icon"><?php echo $icon_start; // phpcs:ignore ?></span>
				</button>

				<!-- Ripple Rings -->
				<?php if ( $settings['ripple_enable'] === 'yes' ) :
					$ripple_mode = $settings['ripple_mode'] ?? 'infinite';
				?>
					<span class="ak-ripple-ring ripple-mode-<?php echo esc_attr( $ripple_mode ); ?>"></span>
					<?php if ( $ripple_mode === 'double' ) : ?>
						<span class="ak-ripple-ring ak-ripple-ring-2 ripple-mode-double"></span>
					<?php endif; ?>
				<?php endif; ?>

				<!-- Tooltip -->
				<?php if ( $settings['show_tooltip'] === 'yes' ) : ?>
					<div class="apeiron-scroll-tooltip"><?php echo esc_html( $data['tooltipStart'] ); ?></div>
				<?php endif; ?>

				<!-- End Notification -->
				<?php if ( $settings['show_end_notification'] === 'yes' ) : ?>
					<div class="apeiron-end-notification" role="alert" aria-live="polite" style="opacity: 0; visibility: hidden;"><?php echo esc_html( $data['endNotificationText'] ); ?></div>
				<?php endif; ?>
			</div>

			<!-- Speed Control -->
			<?php if ( $settings['show_speed_control'] === 'yes' ) : 
				$speed_layout = $settings['speed_control_layout'] ?? 'vertical';
				$speed_position = $settings['speed_control_position'] ?? 'auto';
				$speed_draggable = $settings['speed_control_draggable'] === 'yes';
			?>
				<div class="apeiron-speed-control layout-<?php echo esc_attr( $speed_layout ); ?> pos-<?php echo esc_attr( $speed_position ); ?><?php echo $speed_draggable ? ' draggable' : ''; ?>">
					<?php if ( $speed_draggable ) : ?>
						<div class="speed-drag-handle">
							<svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="5" r="2"/><circle cx="12" cy="5" r="2"/><circle cx="19" cy="5" r="2"/><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
						</div>
					<?php endif; ?>
					<div class="speed-inner">
						<input type="range" class="apeiron-speed-slider" min="1" max="100" value="<?php echo esc_attr( $data['speed'] ); ?>" orient="<?php echo $speed_layout === 'vertical' ? 'vertical' : ''; ?>" aria-label="<?php esc_attr_e( 'Scroll speed', 'any-digital' ); ?>">
						<span class="speed-value"><?php echo esc_html( $data['speed'] ); ?></span>
					</div>
					<?php if ( $settings['show_speed_arrows'] === 'yes' ) : 
					?>
					<div class="speed-arrows">
						<button type="button" class="speed-arrow speed-minus" aria-label="<?php esc_attr_e( 'Kurangi Kecepatan', 'any-digital' ); ?>">
							<span class="speed-arrow-icon-wrap">
								<?php echo $icon_minus; // phpcs:ignore ?>
							</span>
						</button>
						<button type="button" class="speed-arrow speed-plus" aria-label="<?php esc_attr_e( 'Tambah Kecepatan', 'any-digital' ); ?>">
							<span class="speed-arrow-icon-wrap">
								<?php echo $icon_plus; // phpcs:ignore ?>
							</span>
						</button>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<!-- Scroll to Top Button (appears after scroll complete) -->
			<?php if ( $settings['show_scroll_top'] === 'yes' ) : ?>
				<button class="apeiron-scroll-top-btn" type="button" aria-label="<?php esc_attr_e( 'Scroll ke Atas', 'any-digital' ); ?>">
					<?php echo $icon_scroll_top; // phpcs:ignore ?>
				</button>
			<?php endif; ?>

			<!-- Progress Bar (alternative) -->
			<?php if ( $settings['show_progress'] === 'yes' && $settings['progress_type'] === 'bar' ) : ?>
				<div class="apeiron-progress-bar">
					<div class="bar-fill"></div>
				</div>
			<?php endif; ?>
		</div>

		<?php
		// JavaScript logic is in external file: assets/js/widgets/autoscroll.js
		// Enqueued via get_script_depends()
	}
}