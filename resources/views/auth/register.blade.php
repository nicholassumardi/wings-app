<div class="row">
    <div class="col s12">
        <div class="container">
            <div id="register-page" class="row">
                <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                    <form action="{{ url('register') }}" class="register-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <h5 class="ml-4">Register</h5>
                                <p class="ml-4">Join to our community now !</p>
                            </div>
                        </div>
                        <div id="alerts-popup">
                            @if(session('failed'))
                            <div class="container">
                                <div class="row">
                                    <div class="col s10 offset-s1">
                                        <div class="card-alert card gradient-45deg-red-pink">
                                            <div class="card-content white-text">
                                                <p>
                                                    <i class="material-icons">error</i> {{ session('failed') }}
                                                </p>
                                            </div>
                                            <button type="button" class="close white-text" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">mail_outline</i>
                                <input id="email" type="email" name="email" required>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">person_outline</i>
                                <input id="name" type="text" name="name" required>
                                <label for="name" class="center-align">Name</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">lock_outline</i>
                                <input id="password" type="password" name="password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">lock_outline</i>
                                <input id="password-again" type="password" name="password_again" required>
                                <label for="password-again">Password again</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button type="submit"
                                    class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Register</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <p class="margin medium-small"><a href="{{url('/')}}">Already have an account? Login</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
</div>
@push('js')
<script>
    $(function() {
        $('#password-again').on('input', function() {
            $('#alerts-popup').html('')
            var password =  $('#password').val();
            var repeatPassword =  $(this).val();
            if(password !== repeatPassword && repeatPassword != '' ){
               $('#alerts-popup').html(
                ` <div class="container">
                        <div class="row">
                            <div class="col s10 offset-s1">
                                <div class="card-alert card gradient-45deg-amber-amber">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">warning</i>Password not match
                                        </p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                ` );
            }else{
                $('#alerts-popup').html('')
            }
        });
    });
</script>
@endpush