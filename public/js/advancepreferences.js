function advancedPreferences() {
    return {
      trainingModes: [],
      companySizes: [],
      companyCultures: [],
      industries: [],
      training_mode: '',
      company_size: '',
      selected_culture: [],
      selected_industry: [],
  
      trainingModeTips: {
        hybrid: "Mix of onsite and remote training.",
        onsite: "Training happens at the company's location.",
        remotely: "Training can be done from anywhere."
      },
  
      companySizeTips: {
        small: "Tight-knit teams with flexible roles and personal mentoring.",
        medium: "Balanced size with some structure and room to grow.",
        large: "Big companies with structured departments and formal training."
      },
  
      cultureTips: {
        "Autonomous Workstyle": "Work independently with trust and ownership.",
        "Creative & Agile": "Flexible and innovative environment.",
        "Learning-Focused": "Emphasis on growth and learning.",
        "Process-Oriented": "Structured workflows and standard procedures.",
        "Structured Environment": "Clear rules, responsibilities, and hierarchy."
      },
  
      industryTips: {
        "Workforce Management": "Managing teams, schedules, and productivity.",
        "Telecommunications": "Working with mobile, internet, and signals.",
        "Insurance": "Risk management and customer protection.",
        "Software Development": "Building and maintaining software systems.",
        "E-commerce Solutions": "Online shopping and retail systems."
      },
  
      fetchPreferences() {
        fetch("https://train-track-backend.onrender.com/wizard/preferences")
          .then(res => res.json())
          .then(data => {
            this.trainingModes = data.data.training_modes;
            this.companySizes = data.data.company_sizes;
            this.companyCultures = data.data.company_cultures;
            this.industries = data.data.industries;
          });
      },
  
      toggleCulture(item) {
        if (this.selected_culture.includes(item)) {
          this.selected_culture = this.selected_culture.filter(i => i !== item);
        } else if (this.selected_culture.length < 2) {
          this.selected_culture.push(item);
        }
      },
  
      toggleIndustry(item) {
        if (this.selected_industry.includes(item)) {
          this.selected_industry = this.selected_industry.filter(i => i !== item);
        } else {
          if (this.selected_industry.length >= 2) {
            this.selected_industry.shift();
          }
          this.selected_industry.push(item);
        }
      },
  
      clearAll() {
        this.training_mode = '';
        this.company_size = '';
        this.selected_culture = [];
        this.selected_industry = [];
        localStorage.removeItem("preferences");
      },
  
      get canSubmit() {
        return this.training_mode || this.company_size || this.selected_culture.length > 0 || this.selected_industry.length > 0;
      },
  
      goBack() {
        const payload = {
          training_mode: this.training_mode,
          preferred_company_size: this.company_size,
          preferred_culture: this.selected_culture,
          preferred_industry: this.selected_industry,
        };
        localStorage.setItem("preferences", JSON.stringify(payload));
        window.location.href = "/traintrack/nontechnical";
      },
  
      skip() {
        Swal.fire({
          title: 'Redirecting...',
          text: 'Please wait a moment ✨',
          allowOutsideClick: false,
          didOpen: () => Swal.showLoading()
        });
        setTimeout(() => {
          localStorage.setItem("preferences", JSON.stringify({}));
          window.location.href = "/traintrack/summaryresults";
        }, 1000);
      },
  
      submit() {
        const payload = {
          training_mode: this.training_mode,
          preferred_company_size: this.company_size,
          preferred_culture: this.selected_culture,
          preferred_industry: this.selected_industry,
        };
  
        localStorage.setItem("preferences", JSON.stringify(payload));
  
        Swal.fire({
          title: 'Submitting...',
          text: 'Please wait...',
          allowOutsideClick: false,
          didOpen: () => Swal.showLoading()
        });
  
        fetch("https://train-track-backend.onrender.com/wizard/preferences", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload)
        })
          .then(res => {
            if (res.ok) {
              Swal.fire({
                title: 'Success 🎉',
                text: 'Preferences saved!',
                icon: 'success',
                confirmButtonText: 'Continue'
              }).then(() => {
                window.location.href = "/traintrack/summaryresults";
              });
            } else {
              Swal.fire({
                title: 'Oops!',
                text: 'Something went wrong!',
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
          })
          .catch(() => {
            Swal.fire({
              title: 'Network Error',
              text: 'Check your internet connection.',
              icon: 'warning',
              confirmButtonText: 'OK'
            });
          });
      }
    };
  }
  