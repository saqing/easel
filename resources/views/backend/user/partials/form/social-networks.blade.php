<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Twitter</label>
        <input type="text" class="form-control" name="twitter" id="twitter" value="{{ $data['twitter'] }}" placeholder="Twitter Username">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Facebook</label>
        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $data['facebook'] }}" placeholder="Facebook Username">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">GitHub</label>
        <input type="text" class="form-control" name="github" id="github" value="{{ $data['github'] }}" placeholder="GitHub Username">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">LinkedIn</label>
        <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{ $data['linkedin'] }}" placeholder="LinkedIn Username">
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Resume/CV</label>
        <div class="input-group">
            <input type="text" class="form-control" name="resume_cv" id="resume_cv" value="{{ $data['resume_cv'] }}" placeholder="Example: my_resume.pdf" v-model="resume_cv">
            <span class="input-group-btn" style="margin-bottom: 11px">
                <button style="margin-bottom: -5px" type="button" class="btn btn-primary waves-effect" @click="showMediaManager = true">Select Resume</button>
            </span>
        </div>
    </div>
</div>

<br>

<div class="form-group">
    <div class="fg-line">
        <label class="fg-label">Website</label>
        <input type="text" class="form-control" name="url" id="url" value="{{ $data['url'] }}" placeholder="https://www.john-doe.io/">
    </div>
</div>

<media-modal v-if="showMediaManager" @close="showMediaManager = false">
<media-manager
        :is-modal="true"
        selected-event-name="resume-cv"
@close="showMediaManager = false"
>
</media-manager>