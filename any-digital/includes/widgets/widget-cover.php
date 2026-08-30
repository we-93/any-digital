<?php
/**
 * Any Digital - Standard Invitation Cover Widget (Berdasarkan Widget Invitation wellcome.php dari elkit)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access prevention
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

class AnyDigital_Widget_Cover extends Widget_Base {

	public function get_name() {
		return 'any-digital-cover';
	}

	public function get_title() {
		return __( 'Cover Undangan (Invitation)', 'any-digital' );
	}

	public function get_icon() {
		return 'eicon-site-identity';
	}

	public function get_categories() {
		return [ 'any-digital' ];
	}

	public function get_keywords() {
		return [ 'cover', 'invitation', 'undangan', 'sampul', 'welcome', 'opening', 'any digital' ];
	}

	protected function register_controls() {

		/* -------------------------------------------------------------------------- */
		/*                              CONTENT SECTION                               */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Konten Invitation Cover', 'any-digital' ),
			]
		);

		$this->add_control(
			'image_wedding',
			[
				'label'       => __( 'Foto Mempelai', 'any-digital' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => [ 'url' => '' ],
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'text_the_wedding',
			[
				'label'       => __( 'Teks The Wedding Of', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'The Wedding Of', 'any-digital' ),
				'placeholder' => __( 'The Wedding Of', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'text_wedding',
			[
				'label'       => __( 'Nama Mempelai', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Andy & Zhea', 'any-digital' ),
				'placeholder' => __( 'Nama Pengantin', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'text_tgl',
			[
				'label'       => __( 'Tanggal Acara', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Minggu, 31 Desember 2026', 'any-digital' ),
				'placeholder' => __( 'Tanggal acara...', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'text_dear',
			[
				'label'       => __( 'Teks Dear / Kepada', 'any-digital' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'Kpd Bpk/Ibu/Saudara/i', 'any-digital' ),
				'placeholder' => __( 'Kpd Bpk/Ibu/Saudara/i', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'guest_name_default',
			[
				'label'       => __( 'Nama Tamu Default', 'any-digital' ),
				'description' => __( 'Nama tamu default jika tidak ada URL parameter ?to=, ?dear=, atau ?kepada=.', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Tamu Undangan', 'any-digital' ),
				'label_block' => true,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => __( 'Invitation Text (Pesan Undangan)', 'any-digital' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Tanpa Mengurangi Rasa Hormat, Kami Mengundang Anda Untuk Berhadir Di Acara Pernikahan Kami.', 'any-digital' ),
				'placeholder' => __( 'Teks undangan...', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'text_note',
			[
				'label'       => __( 'Keterangan / Catatan Tamu', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Mohon maaf apabila ada kesalahan penulisan nama/gelar', 'any-digital' ),
				'placeholder' => __( 'Mohon maaf apabila...', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'src_type',
			[
				'label'     => __( 'Background Source', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'upload',
				'options'   => [
					'upload' => __( 'Upload Image', 'any-digital' ),
					'link'   => __( 'Image Link', 'any-digital' ),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_upload',
			[
				'label'     => __( 'Upload Image Background', 'any-digital' ),
				'type'      => Controls_Manager::MEDIA,
				'media_type'=> 'image',
				'dynamic'   => [ 'active' => true ],
				'condition' => [ 'src_type' => 'upload' ],
			]
		);

		$this->add_control(
			'image_link',
			[
				'label'       => __( 'Image Link URL', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'https://example.com/picture.jpg',
				'dynamic'     => [ 'active' => true ],
				'condition'   => [ 'src_type' => 'link' ],
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              TOMBOL SECTION                                */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Tombol Buka Undangan', 'any-digital' ),
			]
		);

		$this->add_control(
			'text_open',
			[
				'label'       => __( 'Teks Tombol Buka Undangan', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Buka Undangan', 'any-digital' ),
				'placeholder' => __( 'Buka Undangan', 'any-digital' ),
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
					'value'   => 'far fa-envelope-open',
					'library' => 'fa-regular',
				],
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              STYLE SECTIONS                                */
		/* -------------------------------------------------------------------------- */

		// STYLE: Overlay Background & Opacity
		$this->start_controls_section(
			'section_bg_style',
			[
				'label' => __( 'Background & Overlay', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'popup_bg',
				'label'    => __( 'Overlay Background', 'any-digital' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .overlayy',
			]
		);

		$this->add_control(
			'opacity_invitation',
			[
				'label'     => __( 'Overlay Opacity', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [ 'size' => 0.65 ],
				'range'     => [
					'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.05 ],
				],
				'selectors' => [
					'{{WRAPPER}} .overlayy' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_responsive_control(
			'wdp_invitation_spacing',
			[
				'label'     => __( 'Jarak Antar Teks (Spacing)', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [ 'size' => 15 ],
				'range'     => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .wdp-text' => 'margin-top: {{SIZE}}px;',
					'{{WRAPPER}} .wdp-dear' => 'margin-top: {{SIZE}}px;',
					'{{WRAPPER}} .wdp-name' => 'margin-top: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'wdp_invitation_container_margin_bottom',
			[
				'label'     => __( 'Jarak Ke Tombol', 'any-digital' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [ 'size' => 15 ],
				'range'     => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .wdp-button-wrapper' => 'margin-top: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Foto Mempelai
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Foto Mempelai', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'      => __( 'Lebar Foto', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 500 ],
					'%'  => [ 'min' => 1, 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'      => __( 'Tinggi Foto', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 500 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'object_fit',
			[
				'label'     => __( 'Object Fit', 'any-digital' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''        => __( 'Default', 'any-digital' ),
					'fill'    => __( 'Fill', 'any-digital' ),
					'cover'   => __( 'Cover', 'any-digital' ),
					'contain' => __( 'Contain', 'any-digital' ),
				],
				'default'   => 'cover',
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'label'    => __( 'Border Foto', 'any-digital' ),
				'selector' => '{{WRAPPER}} .elementor-image img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'label'    => __( 'Box Shadow Foto', 'any-digital' ),
				'selector' => '{{WRAPPER}} .elementor-image img',
			]
		);

		$this->end_controls_section();

		// STYLE: Sub-Judul (The Wedding Of)
		$this->start_controls_section(
			'section_txt_the_wedding_style',
			[
				'label' => __( 'The Wedding Of', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'txt_the_wedding_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .wdp-txt-the-wedding',
			]
		);

		$this->add_control(
			'txt_the_wedding_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdp-txt-the-wedding' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'txt_the_wedding_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wdp-txt-the-wedding' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Nama Mempelai
		$this->start_controls_section(
			'section_mempelai_style',
			[
				'label' => __( 'Nama Mempelai', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'mempelai_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .wdp-mempelai',
			]
		);

		$this->add_control(
			'mempelai_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdp-mempelai' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mempelai_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wdp-mempelai' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Tanggal
		$this->start_controls_section(
			'section_tgl_style',
			[
				'label' => __( 'Tanggal Acara', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tgl_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .wdp-tgl',
			]
		);

		$this->add_control(
			'tgl_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdp-tgl' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tgl_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wdp-tgl' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Dear / Kepada
		$this->start_controls_section(
			'section_dear_style',
			[
				'label' => __( 'Dear / Kepada', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'dear_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .wdp-dear',
			]
		);

		$this->add_control(
			'dear_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdp-dear' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dear_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wdp-dear' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Nama Tamu (Invitation Name)
		$this->start_controls_section(
			'section_name_style',
			[
				'label' => __( 'Nama Tamu Undangan', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .wdp-name',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdp-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'name_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wdp-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Invitation Text
		$this->start_controls_section(
			'section_text_invitation_style',
			[
				'label' => __( 'Invitation Text (Pesan Undangan)', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_invitation_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .wdp-text',
			]
		);

		$this->add_control(
			'text_invitation_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdp-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_invitation_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wdp-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Keterangan Note
		$this->start_controls_section(
			'section_keterangan_style',
			[
				'label' => __( 'Keterangan / Catatan', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'keterangan_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .wdp-keterangan',
			]
		);

		$this->add_control(
			'keterangan_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdp-keterangan' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'keterangan_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wdp-keterangan' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Tombol Buka Undangan
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Tombol Buka Undangan', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => __( 'Tipografi Tombol', 'any-digital' ),
				'selector' => '{{WRAPPER}} .wdp-button-wrapper button',
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
					'{{WRAPPER}} .wdp-button-wrapper button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wdp-button-wrapper button svg' => 'fill: {{VALUE}};',
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
					'{{WRAPPER}} .wdp-button-wrapper button' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .wdp-button-wrapper button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wdp-button-wrapper button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Warna Background (Hover)', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdp-button-wrapper button:hover' => 'background-color: {{VALUE}};',
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
				'selector'  => '{{WRAPPER}} .wdp-button-wrapper button',
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
					'{{WRAPPER}} .wdp-button-wrapper button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding Tombol', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wdp-button-wrapper button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Extract guest name safely from URL parameter (?to=, ?dear=, or ?kepada=)
	 */
	private function get_guest_name( $default_name ) {
		$raw_name = '';

		if ( isset( $_GET['dear'] ) && ! empty( $_GET['dear'] ) ) {
			$raw_name = wp_unslash( $_GET['dear'] );
		} elseif ( isset( $_GET['to'] ) && ! empty( $_GET['to'] ) ) {
			$raw_name = wp_unslash( $_GET['to'] );
		} elseif ( isset( $_GET['kepada'] ) && ! empty( $_GET['kepada'] ) ) {
			$raw_name = wp_unslash( $_GET['kepada'] );
		}

		if ( ! empty( $raw_name ) ) {
			return sanitize_text_field( $raw_name );
		}

		return $default_name;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Background Image handling
		if ( 'upload' === $settings['src_type'] ) {
			$image_url = ! empty( $settings['image_upload']['url'] ) ? $settings['image_upload']['url'] : '';
		} else {
			$image_url = ! empty( $settings['image_link'] ) ? $settings['image_link'] : '';
		}

		$photo_url     = ! empty( $settings['image_wedding']['url'] ) ? $settings['image_wedding']['url'] : '';
		$text_subtitle = ! empty( $settings['text_the_wedding'] ) ? $settings['text_the_wedding'] : '';
		$text_couple   = ! empty( $settings['text_wedding'] ) ? $settings['text_wedding'] : '';
		$text_date     = ! empty( $settings['text_tgl'] ) ? $settings['text_tgl'] : '';
		$text_dear     = ! empty( $settings['text_dear'] ) ? $settings['text_dear'] : '';
		$text_inv      = ! empty( $settings['text'] ) ? $settings['text'] : '';
		$text_note     = ! empty( $settings['text_note'] ) ? $settings['text_note'] : '';
		$default_guest = ! empty( $settings['guest_name_default'] ) ? $settings['guest_name_default'] : __( 'Tamu Undangan', 'any-digital' );
		$text_open_btn = ! empty( $settings['text_open'] ) ? $settings['text_open'] : __( 'Buka Undangan', 'any-digital' );

		$guest_name    = $this->get_guest_name( $default_guest );

		$bg_style      = ! empty( $image_url ) ? 'background-image: url(' . esc_url( $image_url ) . ');' : '';
		?>

		<div class="modalx" data-sampul="<?php echo esc_url( $image_url ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
			<div class="overlayy"></div>
			<div class="content-modalx">
				<div class="info_modalx">
					
					<?php if ( ! empty( $photo_url ) ) : ?>
						<div class="elementor-image img">
							<img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( $text_couple ); ?>" />
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $text_subtitle ) ) : ?>
						<div class="wdp-txt-the-wedding"><?php echo esc_html( $text_subtitle ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $text_couple ) ) : ?>
						<div class="wdp-mempelai"><?php echo esc_html( $text_couple ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $text_date ) ) : ?>
						<div class="wdp-tgl"><?php echo esc_html( $text_date ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $text_dear ) ) : ?>
						<div class="wdp-dear"><?php echo esc_html( $text_dear ); ?></div>
					<?php endif; ?>

					<div class="wdp-name namatamu"><?php echo esc_html( $guest_name ); ?></div>

					<?php if ( ! empty( $text_inv ) ) : ?>
						<div class="wdp-text"><?php echo esc_html( $text_inv ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $text_open_btn ) ) : ?>
						<div class="wdp-button-wrapper" id="wdp-button-wrapper">
							<button type="button" class="elementor-button">
								<?php if ( ! empty( $settings['selected_icon']['value'] ) ) : ?>
									<span class="elementor-button-icon">
										<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</span>
								<?php endif; ?>
								<span class="elementor-button-text"><?php echo esc_html( $text_open_btn ); ?></span>
							</button>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $text_note ) ) : ?>
						<div class="wdp-keterangan"><?php echo esc_html( $text_note ); ?></div>
					<?php endif; ?>

				</div>
			</div>
		</div>

		<?php
	}
}
