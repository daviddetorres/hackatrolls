<?php
use Goteo\Application\Lang;
use Goteo\Library\Currency;
use Goteo\Model\Node,
    Goteo\Model\Banner;

$nodeData = Node::get(NODE_ID, LANG);
$banners = Banner::getAll(true, NODE_ID);

$nodeText = str_replace(array('[', ']'), array('<span class="blue">', '</span>'), $nodeData->description);


$currencies = Currency::$currencies;

$num_currencies=count($currencies);

$select_currency=Currency::$currencies[$_SESSION['currency']]['html'];

$langs = Lang::listAll('short');
?>

                        <ul class="currency">
                            <?php foreach ($currencies as $ccyId => $ccy): ?>
                                <?php if ($ccyId == $_SESSION['currency']) continue; ?>
                                <li >
                                <a href="?currency=<?php echo $ccyId ?>"><?php echo $ccy['html'].' '.$ccyId; ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>



                        <ul class="lang">
                            <?php foreach ($langs as $id => $lang): ?>
                                <?php if (Lang::isActive($id)) continue; ?>
                                <li >
                                <a href="?lang=<?php echo $id ?>"><?php echo htmlspecialchars($lang) ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>

<div id="header">
    <h1><?=$this->text('regular-main-header')?></h1>
    <div id="super-header">
		<div id="goteo-logo">
			<ul>
				<li class="home"><a class="node-jump" href="<?php echo GOTEO_URL ?>">Inicio</a></li>
			</ul>
		</div>

	   <div id="rightside" style="float:right;">
           <div id="about">
                <ul>
                    <li><a href="/about"><?php echo str_replace('Goteo', $nodeData->name, $this->text('regular-header-about')); ?></a></li>
                    <li><a href="/blog"><?=$this->text('regular-header-blog')?></a></li>
                    <li><a href="/faq"><?=$this->text('regular-header-faq')?></a></li>
                    <?php if($num_currencies>1) { ?>
                    <li id="currency"><a href="#" ><?php echo $select_currency." ".$_SESSION['currency']; ?></a>

                        <?php // TODO: UL CURRENCY AQUI ?>

                    </li>
                    <?php } ?>

                    <li id="lang"><a href="#" ><?php echo Lang::getShort(); ?></a></li>
                </ul>
            </div>

		</div>

    </div>

    <div id="node-header">
        <div class="logos">
            <div class="node-home"><a href="<?php echo $nodeData->url ?>"><?php echo $nodeData->name ?></a></div>
            <div class="node-intro"><?php echo $nodeText; ?></div>
            <?php if ($nodeData->logo instanceof \Goteo\Model\Image) : ?>
            <div class="node-logo">
                <span><?=$this->text('node-header-sponsorby')?></span>
                <img src="<?php echo $nodeData->logo->getLink(150, 75) ?>" alt="<?php echo htmlspecialchars($nodeData->subtitle) ?>" />
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include __DIR__ . '/../node/menu.html.php' ?>
    <?php include __DIR__ . '/../node/banners.html.php' ?>
</div>
