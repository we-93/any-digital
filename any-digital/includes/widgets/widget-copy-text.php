<?php
/**
 * Any Digital - Copy Text Widget for Elementor
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
use Elementor\Utils;

class AnyDigital_Widget_Copy_Text extends Widget_Base {

	public function get_name() {
		return 'any-digital-copy-text';
	}

	public function get_title() {
		return __( 'Copy Text', 'any-digital' );
	}

	public function get_icon() {
		return 'eicon-copy';
	}

	public function get_categories() {
		return [ 'any-digital' ];
	}

	public function get_keywords() {
		return [ 'copy', 'text', 'clipboard', 'salin', 'rekening', 'any digital' ];
	}

	protected function register_controls() {

		/* -------------------------------------------------------------------------- */
		/*                              CONTENT SECTION                               */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content Copy Text', 'any-digital' ),
			]
		);

		$this->add_control(
			'head',
			[
				'label'       => __( 'Judul Header', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Nomor Rekening / Alamat', 'any-digital' ),
				'placeholder' => __( 'Masukkan judul...', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'image',
			[
				'label'     => __( 'Pilih Gambar / Logo', 'any-digital' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [ 'url' => '' ],
				'dynamic'   => [ 'active' => true ],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dce_clipboard_text',
			[
				'label'       => __( 'Teks yang Disalin', 'any-digital' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( '1234567890', 'any-digital' ),
				'placeholder' => __( 'Teks yang akan disalin pengguna...', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'show_content',
			[
				'label'   => __( 'Tampilkan Teks di Halaman', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'yes' => __( 'Ya, Tampilkan', 'any-digital' ),
					'no'  => __( 'Sembunyikan', 'any-digital' ),
				],
				'default' => 'yes',
			]
		);

		$this->add_control(
			'copy_message',
			[
				'label'       => __( 'Pesan Berhasil Disalin', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Berhasil disalin!', 'any-digital' ),
				'placeholder' => __( 'Berhasil disalin!', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => __( 'Teks Tombol Salin', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Salin Teks', 'any-digital' ),
				'placeholder' => __( 'Salin Teks', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'            => __( 'Ikon Tombol', 'any-digital' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'default'          => [
					'value'   => 'far fa-copy',
					'library' => 'fa-regular',
				],
				'separator'        => 'before',
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
					'{{WRAPPER}} .any-digital-copy-button .elementor-button-content-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'      => __( 'Jarak Ikon', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'size' => 8, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-copy-button .elementor-button-content-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'        => __( 'Alignment Container', 'any-digital' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
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
				'default'      => 'center',
				'selectors'    => [
					'{{WRAPPER}} .any-digital-copy-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              STYLE SECTIONS                                */
		/* -------------------------------------------------------------------------- */

		// STYLE: Judul Header
		$this->start_controls_section(
			'section_head_style',
			[
				'label' => __( 'Judul Header', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'head_text_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .any-digital-copy-head' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'head_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-copy-head',
			]
		);

		$this->add_responsive_control(
			'head_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-copy-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Gambar
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Gambar / Logo', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'      => __( 'Lebar Gambar', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 500 ],
					'%'  => [ 'min' => 1, 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-copy-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label'      => __( 'Margin Gambar', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-copy-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Teks Konten
		$this->start_controls_section(
			'section_contents_style',
			[
				'label' => __( 'Teks Konten', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'contents_text_color',
			[
				'label'     => __( 'Warna Teks', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .any-digital-copy-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'contents_typography',
				'label'    => __( 'Tipografi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-copy-content',
			]
		);

		$this->add_responsive_control(
			'contents_margin',
			[
				'label'      => __( 'Margin', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-copy-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Tombol Salin
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Tombol Salin', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => __( 'Tipografi Tombol', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-copy-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		// Normal State
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
				'selectors' => [
					'{{WRAPPER}} .any-digital-copy-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .any-digital-copy-button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Warna Background', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .any-digital-copy-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover State
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
					'{{WRAPPER}} .any-digital-copy-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .any-digital-copy-button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Warna Background (Hover)', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .any-digital-copy-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __( 'Warna Border (Hover)', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .any-digital-copy-button:hover' => 'border-color: {{VALUE}};',
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
				'selector'  => '{{WRAPPER}} .any-digital-copy-button',
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
					'{{WRAPPER}} .any-digital-copy-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-copy-button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding Tombol', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-copy-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$head              = ! empty( $settings['head'] ) ? $settings['head'] : '';
		$clipboard_content = ! empty( $settings['dce_clipboard_text'] ) ? $settings['dce_clipboard_text'] : '';
		$show_content      = isset( $settings['show_content'] ) ? $settings['show_content'] : 'yes';
		$copy_message      = ! empty( $settings['copy_message'] ) ? $settings['copy_message'] : __( 'Berhasil disalin!', 'any-digital' );
		$button_text       = ! empty( $settings['text'] ) ? $settings['text'] : __( 'Salin Teks', 'any-digital' );
		$image_url         = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';

		$content_style = ( 'yes' === $show_content ) ? '' : 'display: none;';
		?>

		<div class="any-digital-copy-wrapper">
			<?php if ( ! empty( $image_url ) ) : ?>
				<div class="any-digital-copy-image">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $head ); ?>" />
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $head ) ) : ?>
				<div class="any-digital-copy-head"><?php echo esc_html( $head ); ?></div>
			<?php endif; ?>

			<div class="any-digital-copy-content" style="<?php echo esc_attr( $content_style ); ?>">
				<span class="any-digital-clipboard-text"><?php echo wp_kses_post( nl2br( $clipboard_content ) ); ?></span>
			</div>

			<a href="javascript:void(0);" 
			   class="any-digital-copy-button elementor-button" 
			   role="button" 
			   data-clipboard-text="<?php echo esc_attr( $clipboard_content ); ?>"
			   data-message="<?php echo esc_attr( $copy_message ); ?>"
			   data-original-text="<?php echo esc_attr( $button_text ); ?>">
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
