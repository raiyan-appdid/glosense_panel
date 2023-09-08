<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<style>
    body {
        background-color: pink;
    }

    .text-wrapper {
        top: 88px
    }

    .ml9 {
        position: relative;
        font-weight: 600;
        font-size: 15em;
    }

    .ml9 .text-wrapper {
        position: relative;
        display: inline-block;
        padding-top: 0.2em;
        padding-right: 0.05em;
        padding-bottom: 0.1em;
        overflow: hidden;
    }

    .ml9 .letter {
        transform-origin: 50% 100%;
        display: inline-block;
        line-height: 1em;
    }
</style>

<body>
    <section class="hero-section">
        <div class="container-fluid">
            <div class="outer_box text-center p-2">
                <h1 class="ml9">
                    <span class="text-wrapper">
                        <span class="letters">Glosense</span>
                    </span>
                </h1>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script>
        // Wrap every letter in a span
        var textWrapper = document.querySelector('.ml9 .letters');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

        anime.timeline({
                loop: true
            })
            .add({
                targets: '.ml9 .letter',
                scale: [0, 1],
                duration: 1500,
                elasticity: 600,
                delay: (el, i) => 45 * (i + 1)
            });
        setTimeout(() => {
            location.href = `{{ route('home') }}`
        }, 700);
    </script>
</body>

</html>
