@extends('schems.topPanelSchema')

@section('title')
Выставка
@endsection

@section('content')
    <div class="container pt-3">
        <div class="card text-center ">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link future" href="#" id="future">Будущие</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link active" href="#" aria-current="true" id="active">Активные</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link passive" href="#" id="passive">Прошедшие</a>
                    </li>
                </ul>
            </div>
            <div class="card-group p-4" style="display: none" id="firstBlock">
                <div class="container-fluid">
                    <div class="row row-cols-3">
                        @foreach ($exhibitionsFuture as $exhibitionF)
                            <div class="container-fluid">
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $exhibitionF->title }}</h5>
                                            <p class="card-text">{{ $exhibitionF->about }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-group p-4" id="secondBlock">
                <div class="container-fluid">
                    <div class="row row-cols-3">
                        @foreach ($exhibitionsActive as $exhibitionA)
                            <div class="container-fluid">
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$exhibitionA->title}}</h5>
                                            <p class="card-text">{{$exhibitionA->about}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="card-group p-4" style="display: none" id="thirdBlock">
                <div class="container-fluid">
                    <div class="row row-cols-3">
                        @foreach ($exhibitionsPassive as $exhibitionP)
                            <div class="container-fluid">
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $exhibitionP->title }}</h5>
                                            <p class="card-text">{{ $exhibitionP->about }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script>
        function removeAttribute(future, active, passive) {
            future.classList.remove("active");
            future.classList.remove("passive");

            active.classList.remove("active");
            active.classList.remove("passive");

            passive.classList.remove("active");
            passive.classList.remove("passive");
        }

        document.getElementById("active").addEventListener("click", function() {
            removeAttribute(document.getElementById("future"), this, document.getElementById("passive"));

            future.classList.add("passive");
            passive.classList.add("passive");
            active.classList.add("active");
        });

        document.getElementById("passive").addEventListener("click", function() {
            future = document.getElementById("future");
            active = document.getElementById("active");
            if (document.getElementById("future").className.indexOf("active") != -1) {
                console.log(1);
                removeAttribute(document.getElementById("future"), document.getElementById("active"), this);

                active.style.backgroundPosition = "0% 100%";
                active.classList.add("active");
                future.classList.add("passive");
                this.classList.add("passive");


                setTimeout(() => {
                    active.classList.remove("active");
                    active.classList.add("passive");
                    this.classList.remove("passive");
                    this.classList.add("active");
                    active.style.backgroundPosition = "100% 100%";
                }, 500);

            } else {
                console.log(2);

                removeAttribute(document.getElementById("future"), document.getElementById("active"), this);
                active.style.backgroundPosition = "100% 100%";
                active.classList.add("passive");
                future.classList.add("passive");
                this.classList.add("active");
            }
        });

        document.getElementById("future").addEventListener("click", function() {
            passive = document.getElementById("passive");
            active = document.getElementById("active");
            if (document.getElementById("passive").className.indexOf("active") != -1) {
                console.log(3);
                removeAttribute(this, document.getElementById("active"), document.getElementById("passive"));

                active.style.backgroundPosition = "100% 100%";
                active.classList.add("active");
                passive.classList.add("passive");
                this.classList.add("passive");

                setTimeout(() => {
                    active.classList.remove("active");
                    active.classList.add("passive");
                    this.classList.remove("passive");
                    this.classList.add("active");

                    active.style.backgroundPosition = "0% 100%";
                }, 500);

            } else {
                console.log(4);

                removeAttribute(this, document.getElementById("active"), document.getElementById("passive"));
                active.style.backgroundPosition = "0% 100%";
                active.classList.add("passive");
                passive.classList.add("passive");
                this.classList.add("active");
            }
        });


        document.getElementById("future").addEventListener("click", function() {
            document.getElementById("firstBlock").style.display = "block";
            document.getElementById("secondBlock").style.display = "none";
            document.getElementById("thirdBlock").style.display = "none";
        });

        document.getElementById("active").addEventListener("click", function() {
            document.getElementById("firstBlock").style.display = "none";
            document.getElementById("secondBlock").style.display = "block";
            document.getElementById("thirdBlock").style.display = "none";
        });

        document.getElementById("passive").addEventListener("click", function() {
            document.getElementById("firstBlock").style.display = "block";
            document.getElementById("secondBlock").style.display = "none";
            document.getElementById("thirdBlock").style.display = "none";
        });
    </script>

    <style>
        .passive,
        .active {

            border: 0;

            background-repeat: no-repeat;
            background-image: linear-gradient(to right, #dd50b3, #dd50b3);

            background-color: transparent;
            border-radius: 10px;

            transition: background-size 0.5s, color 0.5s;
            text-decoration: none;
        }


        #active {
            background-position: 50% 50%;
            background-color: transparent;
        }

        #passive {
            background-position: 0% 50%;
            background-color: transparent;
        }

        #future {
            background-position: 100% 50%;
            background-color: transparent;
        }

        .active {
            background-size: 100% 100%;
            transition: background-size 0.5s, color 0.5s;
        }

        .passive {
            background-size: 0% 100%;
            transition: background-size 0.5s, color 0.5s;
        }
    </style>
@endsection
