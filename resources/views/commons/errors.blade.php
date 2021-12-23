             @if($errors->any())
            <!-- //$errors->any()は、変数$errorsの中にエラーメッセージがあるかどうかチェックを行うメソッドです。 -->
            <!-- //エラーメッセージがあればtrue、なければfalseを戻します。 -->

            <ul class="row mt-2">
            @foreach($errors->all() as $error)  
                <li class="text-center col-sm-12">{{ $error }}</li>
            @endforeach
            </ul>
            <!-- //$errors->all()にはバリデーションの中のチェックで発生したエラー情報が配列として保持しています。 -->
            <!-- //foreachを使用することで1つ1つのメッセージを取り出すことができます。 -->
            @endif
           