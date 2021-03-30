@extends('Liquid.layouts.main')

@section('title', 'blog-single')
@section('image', 'images/bg_2.jpg')
@section('page-name', 'Blog Single')



@section('content')
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate content">
                    <h1>{{ $blog->name }}</h1>
                    <p><strong>{{ $blog->intro }}</strong></p>
                    {!! $blog->content !!}
                    <div class="tag-widget post-tag-container mb-5 mt-5">
                        <div class="tagcloud">
                            @php
                                $tags = explode(',', $blog->slug);
                            @endphp
                            @foreach ($tags as $tag)
                                @if ($tag)
                                    <a href="{{ route('Liquid.blog.tag', $tag) }}"
                                        class="tag-cloud-link">{{ $tag }}</a>
                                @endif
                            @endforeach
                            {{-- <a href="#" class="tag-cloud-link">Sport</a>
                            <a href="#" class="tag-cloud-link">Tech</a>
                            <a href="#" class="tag-cloud-link">Travel</a> --}}
                        </div>
                    </div>

                    {{-- <div class="about-author d-flex p-4 bg-light">
                        <div class="bio mr-5">
                            <img src="{{ asset('liquorstore-master/') }}/images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
                        </div>
                        <div class="desc">
                            <h3>George Washington</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem
                                necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente
                                consectetur similique, inventore eos fugit cupiditate numquam!</p>
                        </div>
                    </div> --}}


                    {{-- <div class="pt-5 mt-5">
                        <h3 class="mb-5">6 Comments</h3>
                        <ul class="comment-list">
                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="{{ asset('liquorstore-master/') }}/images/person_1.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>John Doe</h3>
                                    <div class="meta">April 12, 2020 at 1:21am</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
                                        necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente
                                        iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply">Reply</a></p>
                                </div>
                            </li>

                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="{{ asset('liquorstore-master/') }}/images/person_1.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>John Doe</h3>
                                    <div class="meta">April 12, 2020 at 1:21am</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
                                        necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente
                                        iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply">Reply</a></p>
                                </div>

                                <ul class="children">
                                    <li class="comment">
                                        <div class="vcard bio">
                                            <img src="{{ asset('liquorstore-master/') }}/images/person_1.jpg" alt="Image placeholder">
                                        </div>
                                        <div class="comment-body">
                                            <h3>John Doe</h3>
                                            <div class="meta">April 12, 2020 at 1:21am</div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem
                                                laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe
                                                enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?
                                            </p>
                                            <p><a href="#" class="reply">Reply</a></p>
                                        </div>


                                        <ul class="children">
                                            <li class="comment">
                                                <div class="vcard bio">
                                                    <img src="{{ asset('liquorstore-master/') }}/images/person_1.jpg" alt="Image placeholder">
                                                </div>
                                                <div class="comment-body">
                                                    <h3>John Doe</h3>
                                                    <div class="meta">April 12, 2020 at 1:21am</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur
                                                        quidem laborum necessitatibus, ipsam impedit vitae autem, eum
                                                        officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum
                                                        impedit necessitatibus, nihil?</p>
                                                    <p><a href="#" class="reply">Reply</a></p>
                                                </div>

                                                <ul class="children">
                                                    <li class="comment">
                                                        <div class="vcard bio">
                                                            <img src="{{ asset('liquorstore-master/') }}/images/person_1.jpg" alt="Image placeholder">
                                                        </div>
                                                        <div class="comment-body">
                                                            <h3>John Doe</h3>
                                                            <div class="meta">April 12, 2020 at 1:21am</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                Pariatur quidem laborum necessitatibus, ipsam impedit vitae
                                                                autem, eum officia, fugiat saepe enim sapiente iste iure!
                                                                Quam voluptas earum impedit necessitatibus, nihil?</p>
                                                            <p><a href="#" class="reply">Reply</a></p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="{{ asset('liquorstore-master/') }}/images/person_1.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>John Doe</h3>
                                    <div class="meta">April 12, 2020 at 1:21am</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
                                        necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente
                                        iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                    <p><a href="#" class="reply">Reply</a></p>
                                </div>
                            </li>
                        </ul>
                        <!-- END comment-list -->

                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Leave a comment</h3>
                            <form action="#" class="p-5 bg-light">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="url" class="form-control" id="website">
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                                </div>

                            </form>
                        </div>
                    </div> --}}
                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            @csrf
                            <div class="form-group">
                                <span class="fa fa-search"></span>
                                <input type="text" class="form-control" name="search_name"
                                    placeholder="Type a keyword and hit enter">
                            </div>
                        </form>
                    </div>
                    {{-- <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Services</h3>
                            <li><a href="#">Relation Problem <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Couples Counseling <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Depression Treatment <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Family Problem <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Personal Problem <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Business Problem <span class="fa fa-chevron-right"></span></a></li>
                        </div>
                    </div> --}}

                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset('liquorstore-master/') }}/images/image_1.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset('liquorstore-master/') }}/images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset('liquorstore-master/') }}/images/image_3.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="sidebar-box ftco-animate">
                        <h3>Tag Cloud</h3>
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">counsel</a>
                            <a href="#" class="tag-cloud-link">problem</a>
                            <a href="#" class="tag-cloud-link">family</a>
                            <a href="#" class="tag-cloud-link">personal</a>
                            <a href="#" class="tag-cloud-link">business</a>
                            <a href="#" class="tag-cloud-link">computer</a>
                            <a href="#" class="tag-cloud-link">house</a>
                            <a href="#" class="tag-cloud-link">technology</a>
                        </div>
                    </div> --}}

                    {{-- <div class="sidebar-box ftco-animate">
                        <h3>Paragraph</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus
                            voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur
                            similique, inventore eos fugit cupiditate numquam!</p>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="home my-3 sidebar pl-lg-5 ftco-animate"><a href="{{ route('Liquid.blog') }}">Back to Blog</a></div>
    <style>
        strong {
            font-weight: bold;
            font-family: sans-serif;
            color: black;
        }

        .content h1 {
            line-height: 100px;
        }

        .content p::first-letter {
            text-transform: capitalize;

        }

        .content p:first-of-type {
            margin: 20px 0 50px 0;
            text-indent: 50px;
            /* background-color: red; */
        }

        div.home {
            display: flex;
            justify-content: center;
        }

        div.home a {
            /* width: 200px; */
            line-height: 50px;
            font-size: 20px;
            background-color: #b7472a;
            color: white;
            /* font-weight: bold; */
            text-align: center;
            padding: 10px 50px;
            border-radius: 40px;
        }

        div.content img {
            max-width: 720px;
            height: auto;
        }

    </style>
    </section> <!-- .section -->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("form").on("submit", function(event) {
                event.preventDefault();
                val = $(this).find("input[name='search_name']").val();
                console.log(val);
                window.location.href = "/liquid/blog/name/" + val;
            })
        })

    </script>

@endsection
