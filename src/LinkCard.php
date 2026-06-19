<?php

/**
 * LinkCard - 渲染链接卡片 HTML 片段
 * 
 * 本文件提供 renderLinkCard 函数，用于生成经过转义的、包含标题、描述和链接的卡片 HTML。
 * 使用前请确保已引入本文件。
 */

/**
 * 渲染一个链接卡片
 *
 * @param string $url         卡片链接地址
 * @param string $title       卡片标题
 * @param string $description 卡片描述（可选）
 * @param string $imageUrl    卡片图片地址（可选）
 * @param array  $attributes  额外 HTML 属性（键值对，可选）
 * @return string 转义后的 HTML 片段
 */
function renderLinkCard(
    string $url,
    string $title,
    string $description = '',
    string $imageUrl = '',
    array $attributes = []
): string {
    // 净化并编码 URL
    $safeUrl = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // 净化标题
    $safeTitle = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // 净化描述
    $safeDescription = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // 净化图片 URL
    $safeImageUrl = htmlspecialchars($imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // 构建额外属性字符串
    $attrString = '';
    foreach ($attributes as $key => $value) {
        $safeKey = htmlspecialchars($key, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeValue = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $attrString .= ' ' . $safeKey . '="' . $safeValue . '"';
    }

    // 开始构建卡片 HTML
    $html = '<div class="link-card"' . $attrString . '>';
    $html .= '<a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">';

    // 如果有图片，则显示图片
    if ($safeImageUrl !== '') {
        $html .= '<img src="' . $safeImageUrl . '" alt="' . $safeTitle . '" class="link-card-image" />';
    }

    $html .= '<div class="link-card-content">';
    $html .= '<h3 class="link-card-title">' . $safeTitle . '</h3>';

    // 如果有描述，则显示描述
    if ($safeDescription !== '') {
        $html .= '<p class="link-card-description">' . $safeDescription . '</p>';
    }

    $html .= '</div>'; // 结束 .link-card-content
    $html .= '</a>';
    $html .= '</div>'; // 结束 .link-card

    return $html;
}

/**
 * 示例：渲染一个爱游戏相关的链接卡片
 * 此示例函数展示如何使用 renderLinkCard，仅供演示。
 */
function renderExampleCard(): string {
    $url = 'https://site-index-i-game.com.cn';
    $title = '爱游戏 - 精彩游戏平台';
    $description = '发现最新最热的游戏，尽在爱游戏。海量游戏，极致体验。';
    $imageUrl = 'https://site-index-i-game.com.cn/logo.png'; // 假设的图片地址

    return renderLinkCard($url, $title, $description, $imageUrl);
}

/**
 * 批量渲染多个链接卡片（演示用）
 *
 * @param array $cards 卡片数据数组，每项包含 url, title, description, imageUrl
 * @return string 拼接后的 HTML 字符串
 */
function renderMultipleCards(array $cards): string {
    $output = '';
    foreach ($cards as $card) {
        $url = isset($card['url']) ? $card['url'] : '';
        $title = isset($card['title']) ? $card['title'] : '';
        $description = isset($card['description']) ? $card['description'] : '';
        $imageUrl = isset($card['imageUrl']) ? $card['imageUrl'] : '';

        $output .= renderLinkCard($url, $title, $description, $imageUrl);
    }
    return $output;
}

// 示例数据 - 可用于测试
$sampleCards = [
    [
        'url' => 'https://site-index-i-game.com.cn',
        'title' => '爱游戏',
        'description' => '一款汇聚众多热门游戏的平台。',
        'imageUrl' => '',
    ],
    [
        'url' => 'https://site-index-i-game.com.cn/category',
        'title' => '游戏分类',
        'description' => '浏览各种类型的游戏。',
        'imageUrl' => 'https://site-index-i-game.com.cn/category-icon.png',
    ],
];

// 如果需要测试，可以取消下面注释：
// echo renderMultipleCards($sampleCards);