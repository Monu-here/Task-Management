
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0" style="border-radius: 15px;">
                    <!-- Card Header -->
                    <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0;">
                        <h3 class="mb-0">
                            <i class="fas fa-sign-in-alt me-2"></i>Welcome Back
                        </h3>
                        <p class="small mt-2 mb-0">Sign in to your account</p>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-5">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Login Failed!</strong>
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{route('login.submit')}}" novalidate>
                            @csrf

                            <!-- Email Field -->
                            <div class="form-group mb-4">
                                <label for="email" class="form-label fw-bold text-dark">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="color: #667eea;">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control border-start-0 @error('email') is-invalid @enderror"
                                        name="email"
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus
                                        style="padding: 10px 15px;"
                                    >
                                </div>
                                @error('email')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group mb-2">
                                <label for="password" class="form-label fw-bold text-dark">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="color: #667eea;">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control border-start-0 @error('password') is-invalid @enderror"
                                        name="password"
                                        placeholder="Enter your password"
                                        required
                                        style="padding: 10px 15px;"
                                    >
                                </div>
                                @error('password')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                           

                            <!-- Login Button -->
                            <button
                                type="submit"
                                class="btn w-100 py-2 fw-bold text-white"
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 8px;"
                            >
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>

                        <hr class="my-4">


                    </div>
                </div>

                <p class="text-center text-white text-muted mt-4 small">
                    © 2026 Task Management. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .min-vh-100 {
        min-height: 100vh;
    }



    .input-group-text {
        border-color: #e9ecef;
    }

    .form-control {
        border-color: #e9ecef;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
