<?php
	if ( ! $edButton2 || empty( $product['button2'] ) ) {
		return;
	}
    $button2Rel = [];
    if ($product['btn2RelNoFollow']) {
        $button2Rel[] = 'nofollow';
    }
    if ($product['btn2RelSponsored']) {
        $button2Rel[] = 'sponsored';
    }
    $button2RelAttr = !empty($button2Rel) ? 'rel="' . implode(' ', $button2Rel) . '"' : '';
?>
<div class="affx-btn-inner">
    <a href="<?php echo esc_url(do_shortcode($product['button2URL'])) ?>" class="affiliatex-button secondary <?php echo $edButton2Icon ? 'icon-btn icon-' . esc_attr($button2IconAlign) : '' ?>" <?php echo $button2RelAttr ?> <?php echo $product['btn2OpenInNewTab'] ? 'target="_blank"' : '' ?> <?php echo $product['btn2Download'] ? 'download' : '' ?>>
        <?php if($edButton2Icon && $button2IconAlign === 'left'): ?>
            <i class="button-icon <?php echo esc_attr($button2Icon['value']) ?>"></i>
        <?php endif; ?>
        <?php echo wp_kses_post($product['button2']) ?>
        <?php if($edButton2Icon && $button2IconAlign === 'right'): ?>
            <i class="button-icon <?php echo esc_attr($button2Icon['value']) ?>"></i>
        <?php endif; ?>
    </a>
</div>
