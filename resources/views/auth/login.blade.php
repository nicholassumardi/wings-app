<div class="row">
	<div class="col s12">
		<div class="container">
			<div id="login-page" class="row">
				<div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
					<form action="{{ url('/') }}" method="POST">
						@csrf
						<div class="row">
							<div class="input-field col s12">
								<h5 class="ml-4">Sign in</h5>
							</div>
						</div>
						@if(session('success'))
						<div class="container">
							<div class="row">
								<div class="col s10 offset-s1">
									<div class="card-alert card gradient-45deg-green-teal">
										<div class="card-content white-text">
											<p>
												<i class="material-icons">check</i> {{session('success')}}
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
						@elseif(session('info'))
						<div class="container">
							<div class="row">
								<div class="col s10 offset-s1">
									<div class="card-alert card gradient-45deg-amber-amber">
										<div class="card-content white-text">
											<p>
												<i class="material-icons">warning</i>{{session('info')}}
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
						@elseif(session('failed'))
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
						<div class="row margin">
							<div class="input-field col s12">
								<i class="material-icons prefix pt-2">mail_outline</i>
								<input id="email" type="text" name="email" required>
								<label for="email" class="center-align">email</label>
							</div>
						</div>
						<div class="row margin">
							<div class="input-field col s12">
								<i class="material-icons prefix pt-2">lock_outline</i>
								<input id="password" type="password" name="password" required>
								<label for="password">Password</label>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m12 l12 ml-2 mt-1">
								<p>
									<label>
										<input type="checkbox" id="showPassword" />
										<span>Show Password</span>
									</label>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<button
									class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12"
									type="submit" onclick="">Login</button>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<p class="margin medium-small"><a href="{{url('register')}}">Don't have an account?
										Register</a>
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
			$('#showPassword').click(function(){
				if($(this).is(':checked')){
					$('#password').attr('type', 'text');
				}else{
					$('#password').attr('type', 'password');
				}
			});
			
			$("#login_form").submit(function(event) {
				event.preventDefault();
				if($('#email').val() !== '' && $('#password').val() !== ''){
					$.ajax({
					 url: '{{ url("login/auth") }}',
					 type: 'POST',
					 dataType: 'JSON',
					 contentType: false,
					 processData: false,
					 data: new FormData($('#login_form')[0]),
					 cache: true,
					 headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					 },
					 beforeSend: function() {
						
					 },
					 success: function(response) {
						
						if(response.status == 200) {
							setTimeout(function() {
								location.reload();
							}, 1500);							
							swal({
								title: 'Success',
								text: response.message,
								icon: 'success'
							});
						} else if(response.status == 422) {
							swal({
								title: 'Validation',
								text: response.message,
								icon: 'warning'
							});
						}
					 },
					 error: function() {
						swal({
							title: 'Ups!',
							text: 'Check your internet connection.',
							icon: 'error'
						});
					 }
				  });
				}else{
					swal({
						title: 'Ups, error.',
						text: 'Please fill in the forms.',
						icon: 'error'
					});
				}
			});
		});
</script>
@endpush