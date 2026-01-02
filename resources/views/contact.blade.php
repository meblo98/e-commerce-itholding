@extends('layouts.app')

@section('title', 'Page Contact')

@section('content')

    <!-- xc-breadcrumb area start -->
    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span><a href="{{ url('/') }}">Accueil</a></span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span>Contact</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- xc-breadcrumb area end -->

    <div class="xc-contact-one pt-80 pb-40">
        <div class="container">
            <div class="row gutter-y-30">
                <div class="col-md-4">
                    <h3 class="xc-contact-one__title">Besoin d'appeler ?</h3>
                    <p class="xc-contact-one__info">
                        Nous sommes là pour vous aider 24 heures sur 24, 7 jours sur 7. N'hésitez pas à nous contacter
                        par téléphone ou par e-mail.
                    </p>

                    <div class="xc-contact-one__cta">
                        <div class="xc-contact-one__icon">
                            <span><i class="icon-phone"></i></span>
                        </div>
                        <div class="xc-contact-one__ct">
                            <h4 class="xc-contact-one__head">Telephone</h4>
                            <a href="tel:(123)4567890">(123) 456 7890</a>
                        </div>

                    </div>
                    <div class="xc-contact-one__cta">
                        <div class="xc-contact-one__icon">
                            <span><i class="icon-email"></i></span>
                        </div>
                        <div class="xc-contact-one__ct">
                            <h4 class="xc-contact-one__head">Email</h4>
                            <a href="mailto:contact@thimpress.com">contact@thimpress.com</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="xc-contact-one__map">
                        <iframe src="https://maps.google.com/maps?q=14.754141069197278,-17.46845351022378&z=15&output=embed"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>

                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7298.274922354233!2d90.34987890702513!3d23.849252062908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1662780394373!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="xc-contact-main pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="xc-contact-main__title">Nous contacter</h3>
                    <p class="xc-contact-main__info">Votre adresse e-mail ne sera pas publiée. Les champs obligatoires sont
                        marqués *
                    </p>
                </div>
                <form action="#" class="xc-contact-main__form">
                    <div class="row gutter-y-30">
                        <div class="col-lg-6">
                            <div class="xc-form__input">
                                <input type="text" placeholder="Votre Nom *" required="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="xc-form__input">
                                <input type="email" placeholder="Votre Email *" required="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="xc-form__input">
                                <input type="text" placeholder="Sujet *">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="xc-form__input">
                                <input type="text" placeholder="Téléphone">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="xc-form__textarea">
                                <textarea name="message" placeholder="Message *" required=""></textarea>
                                <div class="xc-form__textarea-check mt-20 mb-25">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">
                                            Enregistrer mon nom, mon e-mail dans ce navigateur pour la prochaine fois que je
                                            commenterai
                                        </label>
                                    </div>
                                </div>
                                <button class="swiftcart-btn">Envoyer message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
