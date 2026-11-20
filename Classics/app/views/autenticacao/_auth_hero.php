        <?php
        // Usa a imagem local (public/img/login-cataratas.jpg) quando ela existir; senão, a do CSS
        $imagemLoginLocal = is_file(__DIR__ . '/../../../public/img/login-cataratas.jpg');
        ?>
        <div class="cl-auth-hero"<?= $imagemLoginLocal ? ' style="background-image: url(\'' . URL_BASE . '/img/login-cataratas.jpg\');"' : '' ?>>
            <div class="cl-auth-hero-content">
                <a href="<?= URL_BASE ?>/" class="cl-brand">
                    <span class="cl-logo">C</span>
                    <span class="cl-brand-name text-white">Classics</span>
                </a>

                <div>
                    <p class="cl-auth-eyebrow mb-3">Sua próxima aventura começa aqui</p>
                    <h1 class="mb-4">Viva momentos<br><em>inesquecíveis</em></h1>
                    <p>Conectamos você às melhores experiências de lazer e turismo, oferecidas por empresas parceiras.</p>
                </div>
            </div>
        </div>
