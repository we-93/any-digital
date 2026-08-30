<?php
/**
 * Any Digital - WhatsApp Widget for Elementor
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

class AnyDigital_Widget_Whatsapp extends Widget_Base {

	public function get_name() {
		return 'any-digital-whatsapp';
	}

	public function get_title() {
		return __( 'WhatsApp Button', 'any-digital' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'any-digital' ];
	}

	public function get_keywords() {
		return [ 'whatsapp', 'wa', 'chat', 'tombol', 'any digital' ];
	}

	protected function register_controls() {

		/* -------------------------------------------------------------------------- */
		/*                              CONTENT SECTION                               */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_whatsapp',
			[
				'label' => __( 'WhatsApp Button Settings', 'any-digital' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => __( 'Teks Tombol', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Klik WhatsApp', 'any-digital' ),
				'placeholder' => __( 'Klik WhatsApp', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'phone',
			[
				'label'       => __( 'Nomor WhatsApp', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '081234567890',
				'placeholder' => '08xxxxx / 628xxxxx',
				'description' => __( 'Masukkan nomor WhatsApp (contoh: 081234567890). Format akan disesuaikan otomatis.', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'message',
			[
				'label'       => __( 'Pesan Default WhatsApp', 'any-digital' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Halo Admin, saya ingin menanyakan informasi lebih lanjut.', 'any-digital' ),
				'placeholder' => __( 'Pesan yang otomatis terisi...', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'target',
			[
				'label'        => __( 'Buka di Tab Baru', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Ya', 'any-digital' ),
				'label_off'    => __( 'Tidak', 'any-digital' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'       => __( 'Ikon Tombol', 'any-digital' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'fab fa-whatsapp',
					'library' => 'fa-brands',
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
					'{{WRAPPER}} .any-digital-whatsapp-button .elementor-button-content-wrapper' => 'flex-direction: {{VALUE}};',
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
					'{{WRAPPER}} .any-digital-whatsapp-button .elementor-button-content-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment Tombol', 'any-digital' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Kiri', 'any-digital' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Tengah', 'any-digital' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Kanan', 'any-digital' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .any-digital-whatsapp-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              STYLE SECTIONS                                */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Tombol WhatsApp', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => __( 'Tipografi Tombol', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-whatsapp-button',
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
					'{{WRAPPER}} .any-digital-whatsapp-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .any-digital-whatsapp-button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Warna Background', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#25d366',
				'selectors' => [
					'{{WRAPPER}} .any-digital-whatsapp-button' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .any-digital-whatsapp-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .any-digital-whatsapp-button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Warna Background (Hover)', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1ebd56',
				'selectors' => [
					'{{WRAPPER}} .any-digital-whatsapp-button:hover' => 'background-color: {{VALUE}};',
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
				'selector'  => '{{WRAPPER}} .any-digital-whatsapp-button',
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
					'{{WRAPPER}} .any-digital-whatsapp-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-whatsapp-button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding Tombol', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-whatsapp-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Convert Indonesian / raw phone number to clean international 628xxx format
	 */
	private function format_phone_number( $phone ) {
		$phone = preg_replace( '/^8/', '08', $phone );
		$phone = preg_replace( '/[^0-9]/', '', $phone );
		$phone = preg_replace( '/^620/', '62', $phone );
		$phone = preg_replace( '/^0/', '62', $phone );
		return $phone;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$text     = ! empty( $settings['text'] ) ? $settings['text'] : __( 'Klik WhatsApp', 'any-digital' );
		$phone    = ! empty( $settings['phone'] ) ? $this->format_phone_number( $settings['phone'] ) : '';
		$message  = ! empty( $settings['message'] ) ? $settings['message'] : '';
		$target   = ( 'yes' === $settings['target'] ) ? '_blank' : '_self';

		$wa_url   = 'https://api.whatsapp.com/send?phone=' . esc_attr( $phone );
		if ( ! empty( $message ) ) {
			$wa_url .= '&text=' . rawurlencode( $message );
		}
		?>

		<div class="any-digital-whatsapp-wrapper">
			<a href="<?php echo esc_url( $wa_url ); ?>" 
			   target="<?php echo esc_attr( $target ); ?>" 
			   rel="noopener noreferrer" 
			   class="any-digital-whatsapp-button elementor-button" 
			   role="button">
				<div class="elementor-button-content-wrapper">
					<?php if ( ! empty( $settings['selected_icon']['value'] ) ) : ?>
						<span class="elementor-button-icon">
							<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php endif; ?>
					<span class="elementor-button-text"><?php echo esc_html( $text ); ?></span>
				</div>
			</a>
		</div>

		<?php
	}
}
