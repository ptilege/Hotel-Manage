<template>
    <div class="contact-form">
        <form class="form-wrap" id="contactForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input
                            type="text"
                            placeholder="Name*"
                            id="name"
                            required=""
                            v-model="form.name"
                        />
                        <div class="help-block with-errors">{{form.errors.name}}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input
                            type="email"
                            id="email"
                            required=""
                            placeholder="Email*"
                            v-model="form.email"
                        />
                        <div class="help-block with-errors">{{form.errors.email}}</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input
                            type="text"
                            placeholder="Subject*"
                            id="msg_subject"
                            required=""
                            v-model="form.subject"
                        />
                        <div class="help-block with-errors">{{form.errors.subject}}</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group v1">
                        <textarea
                            id="message"
                            placeholder="Your Messages.."
                            cols="30"
                            rows="10"
                            required=""
                            v-model="form.message"
                        ></textarea>
                        <div class="help-block with-errors">{{form.errors.message}}</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check checkbox">
                        <input
                            value="I agree to the terms and privacy policy."
                            class="form-check-input"
                            type="checkbox"
                            id="gridCheck"
                            required=""
                            v-model="form.is_agree"
                        />
                        <label class="form-check-label" for="gridCheck">
                            I agree to the
                            <Link class="link style1" href="terms-of-service.html"
                                >terms &amp; conditions</Link
                            >
                            and
                            <Link class="link style1" href="privacy-policy.html"
                                >privacy policy</Link
                            >
                        </label>
                        <div
                            class="help-block with-errors gridCheck-error"
                        >{{form.errors.is_agree}}</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn style2">
                        Send Message
                    </button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
export default {
    data() {
        return {
            form: useForm({
                name:"",
                email:"",
                subject:"",
                message:"",
                is_agree:"",
            })
        }
    }
};
</script>

<style></style>
