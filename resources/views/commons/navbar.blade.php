<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                
                <!-- 横幅が狭い時に出るハンバーガーボタン -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- ホームへ戻るリンク。ブランドロゴなどを置く。  public/ 直下に public/images/logo.png を-->
                <a class="navbar-left" href="/"><img src="{{ secure_asset("images/logo.png") }}" alt="Monolist"></a>
            </div>
            
            <!-- メニュー項目 -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('signup.get') }}">新規登録</a></li>
                    <li><a href="#">ログイン</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>