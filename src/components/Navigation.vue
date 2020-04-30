<template>
    <!-- ::Includes/navigation -->
        <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
                        aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar_global">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global"
                                        aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-hover align-items-lg-center shadowed">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link">
                                <span class="nav-link-inner--text">Home</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/news" class="nav-link">
                                <span class="nav-link-inner--text">News</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/council" class="nav-link">
                                <span class="nav-link-inner--text">Council</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/awoo/random" class="nav-link">
                                <span class="nav-link-inner--text">Awoo Pics</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a href="https://discord.gg/wolke" class="nav-link ajax">
                                <span class="nav-link-inner--text">Discord</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                        <li class="nav-item">
                            <!-- TODO: check for login -->
                            <div class="dropdown">
                                <button class="btn btn-neutral dropdown-toggle"  style="text-transform: unset" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!-- TODO: Functionality, check for role -->
                                    <span style="font-size: 14px;color: white;padding: 4px;background: var(--red);border-radius: 4px;margin-right: 6px;text-transform: capitalize">Council</span> User
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item ajax" n:href="Awooers:view $user->id">View Profile</a>
                                    <a class="dropdown-item ajax disabled" n:href="Homepage:awoos" >Go Awoo</a>
                                    {if $user->isAllowed("admin", "view")}<a class="dropdown-item ajax" n:href="Admin:default">Admin Panel</a>{/if}
                                    <a class="dropdown-item ajax" n:href="Auth:logout">Logout</a>
                                </div>
                            </div>
                            <!-- TODO: check for login - else
                            <a href="#" data-toggle="modal" data-target="#modal-form"
                               class="btn btn-neutral btn-ico">
                                <span class="btn-inner--icon"><i class="fas fa-lock"></i></span><span
                                    class="nav-link-inner--text"> Login</span>
                            </a>
                            -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- \::Includes/navigation -->
</template>

<script>
    export default {
        name: 'Navigation'
    }
</script>