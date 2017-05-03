<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Generate PDF with DOMPDF</title>

    <style type="text/css">
        @font-face {
            font-family: 'Raleway';
            src: url('{!! storage_path('fonts/Raleway-regular/Raleway-regular.ttf') !!}') format('truetype');
        }

        @font-face {
            font-family: 'Raleway Bold';
            src: url('{!! storage_path('fonts/Raleway-700/Raleway-700.ttf') !!}') format('truetype');
        }

        body {
            font-family: Raleway;
            line-height: 1.3rem;
        }

        .h1 {
            font-family: 'Raleway Bold';
            font-size: 2em;
        }
    </style>
</head>
<body>

<p class="h1">Contract ID: {{ $id }}</p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto autem consequuntur corporis cumque deserunt, dicta distinctio ducimus ea error et ex fuga id illum impedit magnam minus natus nemo nihil non nostrum numquam quas quia quidem quo repudiandae sed sequi suscipit tempore vero voluptate. Est iure nam nesciunt quam? Adipisci animi asperiores beatae culpa cum dolore enim ex exercitationem facilis fuga impedit iste laboriosam laudantium nam nostrum odit officiis saepe tempora
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto autem consequuntur corporis cumque deserunt, dicta distinctio ducimus ea error et ex fuga id illum impedit magnam minus natus nemo nihil non nostrum numquam quas quia quidem quo repudiandae sed sequi suscipit tempore vero voluptate. Est iure nam nesciunt quam? Adipisci animi asperiores beatae culpa cum dolore enim ex exercitationem facilis fuga impedit iste laboriosam laudantium nam nostrum odit officiis saepe tempora
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto autem consequuntur corporis cumque deserunt, dicta distinctio ducimus ea error et ex fuga id illum impedit magnam minus natus nemo nihil non nostrum numquam quas quia quidem quo repudiandae sed sequi suscipit tempore vero voluptate. Est iure nam nesciunt quam? Adipisci animi asperiores beatae culpa cum dolore enim ex exercitationem facilis fuga impedit iste laboriosam laudantium nam nostrum odit officiis saepe tempora
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto autem consequuntur corporis cumque deserunt, dicta distinctio ducimus ea error et ex fuga id illum impedit magnam minus natus nemo nihil non nostrum numquam quas quia quidem quo repudiandae sed sequi suscipit tempore vero voluptate. Est iure nam nesciunt quam? Adipisci animi asperiores beatae culpa cum dolore enim ex exercitationem facilis fuga impedit iste laboriosam laudantium nam nostrum odit officiis saepe tempora
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto autem consequuntur corporis cumque deserunt, dicta distinctio ducimus ea error et ex fuga id illum impedit magnam minus natus nemo nihil non nostrum numquam quas quia quidem quo repudiandae sed sequi suscipit tempore vero voluptate. Est iure nam nesciunt quam? Adipisci animi asperiores beatae culpa cum dolore enim ex exercitationem facilis fuga impedit iste laboriosam laudantium nam nostrum odit officiis saepe tempora
    temporibus totam unde, veniam vitae voluptates. Eum, fuga, mollitia!</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci aliquid animi cupiditate deleniti deserunt, distinctio doloribus ea earum eos est facilis hic nam optio, perferendis quam ratione sit soluta tempora veniam voluptas voluptates? Deleniti illum iure necessitatibus? Aspernatur eveniet fuga incidunt nulla possimus sapiente tempore voluptatibus. A accusamus adipisci aperiam, aspernatur atque corporis ea eos minima numquam obcaecati placeat quisquam ratione recusandae repellat
    repellendus sint vero vitae voluptates! Accusamus ea eaque earum error mollitia, neque pariatur perspiciatis quaerat quo reiciendis! Accusamus assumenda blanditiis, dolorum est exercitationem ipsa itaque molestias mollitia neque nobis nostrum omnis ratione repellat reprehenderit, tempore vero voluptas voluptates! Beatae consequatur eveniet officiis possimus repudiandae similique tempora voluptate. Aperiam autem corporis dolorum ea exercitationem laboriosam, laudantium magni possimus quaerat
    quibusdam repellat repudiandae! Accusamus atque autem doloremque dolores eum molestiae nobis odio quasi quos recusandae sint unde, vitae? Aliquam, aut corporis debitis facere, harum hic impedit iure, laboriosam minus natus repudiandae sunt velit voluptas. Amet nisi nobis placeat voluptatibus? Aut eum explicabo in iste mollitia qui vel! Alias eos numquam obcaecati quasi saepe tempore voluptas? Fugit, sapiente.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci aliquid animi cupiditate deleniti deserunt, distinctio doloribus ea earum eos est facilis hic nam optio, perferendis quam ratione sit soluta tempora veniam voluptas voluptates? Deleniti illum iure necessitatibus? Aspernatur eveniet fuga incidunt nulla possimus sapiente tempore voluptatibus. A accusamus adipisci aperiam, aspernatur atque corporis ea eos minima numquam obcaecati placeat quisquam ratione recusandae repellat
    repellendus sint vero vitae voluptates! Accusamus ea eaque earum error mollitia, neque pariatur perspiciatis quaerat quo reiciendis! Accusamus assumenda blanditiis, dolorum est exercitationem ipsa itaque molestias mollitia neque nobis nostrum omnis ratione repellat reprehenderit, tempore vero voluptas voluptates! Beatae consequatur eveniet officiis possimus repudiandae similique tempora voluptate. Aperiam autem corporis dolorum ea exercitationem laboriosam, laudantium magni possimus quaerat
    quibusdam repellat repudiandae! Accusamus atque autem doloremque dolores eum molestiae nobis odio quasi quos recusandae sint unde, vitae? Aliquam, aut corporis debitis facere, harum hic impedit iure, laboriosam minus natus repudiandae sunt velit voluptas. Amet nisi nobis placeat voluptatibus? Aut eum explicabo in iste mollitia qui vel! Alias eos numquam obcaecati quasi saepe tempore voluptas? Fugit, sapiente.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci aliquid animi cupiditate deleniti deserunt, distinctio doloribus ea earum eos est facilis hic nam optio, perferendis quam ratione sit soluta tempora veniam voluptas voluptates? Deleniti illum iure necessitatibus? Aspernatur eveniet fuga incidunt nulla possimus sapiente tempore voluptatibus. A accusamus adipisci aperiam, aspernatur atque corporis ea eos minima numquam obcaecati placeat quisquam ratione recusandae repellat
    repellendus sint vero vitae voluptates! Accusamus ea eaque earum error mollitia, neque pariatur perspiciatis quaerat quo reiciendis! Accusamus assumenda blanditiis, dolorum est exercitationem ipsa itaque molestias mollitia neque nobis nostrum omnis ratione repellat reprehenderit, tempore vero voluptas voluptates! Beatae consequatur eveniet officiis possimus repudiandae similique tempora voluptate. Aperiam autem corporis dolorum ea exercitationem laboriosam, laudantium magni possimus quaerat
    quibusdam repellat repudiandae! Accusamus atque autem doloremque dolores eum molestiae nobis odio quasi quos recusandae sint unde, vitae? Aliquam, aut corporis debitis facere, harum hic impedit iure, laboriosam minus natus repudiandae sunt velit voluptas. Amet nisi nobis placeat voluptatibus? Aut eum explicabo in iste mollitia qui vel! Alias eos numquam obcaecati quasi saepe tempore voluptas? Fugit, sapiente.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci aliquid animi cupiditate deleniti deserunt, distinctio doloribus ea earum eos est facilis hic nam optio, perferendis quam ratione sit soluta tempora veniam voluptas voluptates? Deleniti illum iure necessitatibus? Aspernatur eveniet fuga incidunt nulla possimus sapiente tempore voluptatibus. A accusamus adipisci aperiam, aspernatur atque corporis ea eos minima numquam obcaecati placeat quisquam ratione recusandae repellat
    repellendus sint vero vitae voluptates! Accusamus ea eaque earum error mollitia, neque pariatur perspiciatis quaerat quo reiciendis! Accusamus assumenda blanditiis, dolorum est exercitationem ipsa itaque molestias mollitia neque nobis nostrum omnis ratione repellat reprehenderit, tempore vero voluptas voluptates! Beatae consequatur eveniet officiis possimus repudiandae similique tempora voluptate. Aperiam autem corporis dolorum ea exercitationem laboriosam, laudantium magni possimus quaerat
    quibusdam repellat repudiandae! Accusamus atque autem doloremque dolores eum molestiae nobis odio quasi quos recusandae sint unde, vitae? Aliquam, aut corporis debitis facere, harum hic impedit iure, laboriosam minus natus repudiandae sunt velit voluptas. Amet nisi nobis placeat voluptatibus? Aut eum explicabo in iste mollitia qui vel! Alias eos numquam obcaecati quasi saepe tempore voluptas? Fugit, sapiente.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci aliquid animi cupiditate deleniti deserunt, distinctio doloribus ea earum eos est facilis hic nam optio, perferendis quam ratione sit soluta tempora veniam voluptas voluptates? Deleniti illum iure necessitatibus? Aspernatur eveniet fuga incidunt nulla possimus sapiente tempore voluptatibus. A accusamus adipisci aperiam, aspernatur atque corporis ea eos minima numquam obcaecati placeat quisquam ratione recusandae repellat
    repellendus sint vero vitae voluptates! Accusamus ea eaque earum error mollitia, neque pariatur perspiciatis quaerat quo reiciendis! Accusamus assumenda blanditiis, dolorum est exercitationem ipsa itaque molestias mollitia neque nobis nostrum omnis ratione repellat reprehenderit, tempore vero voluptas voluptates! Beatae consequatur eveniet officiis possimus repudiandae similique tempora voluptate. Aperiam autem corporis dolorum ea exercitationem laboriosam, laudantium magni possimus quaerat
    quibusdam repellat repudiandae! Accusamus atque autem doloremque dolores eum molestiae nobis odio quasi quos recusandae sint unde, vitae? Aliquam, aut corporis debitis facere, harum hic impedit iure, laboriosam minus natus repudiandae sunt velit voluptas. Amet nisi nobis placeat voluptatibus? Aut eum explicabo in iste mollitia qui vel! Alias eos numquam obcaecati quasi saepe tempore voluptas? Fugit, sapiente.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci aliquid animi cupiditate deleniti deserunt, distinctio doloribus ea earum eos est facilis hic nam optio, perferendis quam ratione sit soluta tempora veniam voluptas voluptates? Deleniti illum iure necessitatibus? Aspernatur eveniet fuga incidunt nulla possimus sapiente tempore voluptatibus. A accusamus adipisci aperiam, aspernatur atque corporis ea eos minima numquam obcaecati placeat quisquam ratione recusandae repellat
    repellendus sint vero vitae voluptates! Accusamus ea eaque earum error mollitia, neque pariatur perspiciatis quaerat quo reiciendis! Accusamus assumenda blanditiis, dolorum est exercitationem ipsa itaque molestias mollitia neque nobis nostrum omnis ratione repellat reprehenderit, tempore vero voluptas voluptates! Beatae consequatur eveniet officiis possimus repudiandae similique tempora voluptate. Aperiam autem corporis dolorum ea exercitationem laboriosam, laudantium magni possimus quaerat
    quibusdam repellat repudiandae! Accusamus atque autem doloremque dolores eum molestiae nobis odio quasi quos recusandae sint unde, vitae? Aliquam, aut corporis debitis facere, harum hic impedit iure, laboriosam minus natus repudiandae sunt velit voluptas. Amet nisi nobis placeat voluptatibus? Aut eum explicabo in iste mollitia qui vel! Alias eos numquam obcaecati quasi saepe tempore voluptas? Fugit, sapiente.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci aliquid animi cupiditate deleniti deserunt, distinctio doloribus ea earum eos est facilis hic nam optio, perferendis quam ratione sit soluta tempora veniam voluptas voluptates? Deleniti illum iure necessitatibus? Aspernatur eveniet fuga incidunt nulla possimus sapiente tempore voluptatibus. A accusamus adipisci aperiam, aspernatur atque corporis ea eos minima numquam obcaecati placeat quisquam ratione recusandae repellat
    repellendus sint vero vitae voluptates! Accusamus ea eaque earum error mollitia, neque pariatur perspiciatis quaerat quo reiciendis! Accusamus assumenda blanditiis, dolorum est exercitationem ipsa itaque molestias mollitia neque nobis nostrum omnis ratione repellat reprehenderit, tempore vero voluptas voluptates! Beatae consequatur eveniet officiis possimus repudiandae similique tempora voluptate. Aperiam autem corporis dolorum ea exercitationem laboriosam, laudantium magni possimus quaerat
    quibusdam repellat repudiandae! Accusamus atque autem doloremque dolores eum molestiae nobis odio quasi quos recusandae sint unde, vitae? Aliquam, aut corporis debitis facere, harum hic impedit iure, laboriosam minus natus repudiandae sunt velit voluptas. Amet nisi nobis placeat voluptatibus? Aut eum explicabo in iste mollitia qui vel! Alias eos numquam obcaecati quasi saepe tempore voluptas? Fugit, sapiente.</p>
<div style="clear: both;"></div>
<div>
    @if($sign)
        <img src="{!! storage_path('app/'.$sign) !!}" alt="owner signature logo" style="float: left;">
    @else
        <img src="http://zapro.uk/vendor/zapro/images/zapro-logo.png" alt="zapro logo" style="float: left;">
    @endif
    <img src="http://zapro.uk/vendor/zapro/images/zapro-logo.png" alt="zapro logo" style="float: right;">
    <div style="clear: both;"></div>
</div>
</body>
</html>