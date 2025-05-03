document.addEventListener('DOMContentLoaded', async () => {
    const showMoreButtons = document.querySelectorAll('.show-more-button');
    showMoreButtons.forEach(button => {
      button.addEventListener('click', function () {
        const card = button.closest('.position-card');
        const companySection = card.querySelector('.company-list');
        companySection.classList.toggle('hidden');
        button.innerHTML = companySection.classList.contains('hidden') ? 'Show More ▼' : 'Show Less ▲';
      });
    });
  
    try {
      const res = await fetch('/api/summary');
      const data = await res.json();
  
      // Update match values
      document.querySelector('.position-title').textContent = data.position_name;
      document.getElementById('fitBar').style.width = `${data.match_score}%`;
      document.getElementById('fitLabel').textContent = `Strong Fit - ${data.match_score}%`;
  
      updateCircularProgress('subjectMatchCircle', data.subject_score);
      updateCircularProgress('technicalSkillCircle', data.technical_score);
      updateCircularProgress('nonTechnicalSkillCircle', data.non_technical_score);
  
      // Company cards
      const companyList = document.getElementById('companyList');
      companyList.innerHTML = '';
      data.companies.forEach((company, index) => {
        const div = document.createElement('div');
        div.className = 'company-card';
        div.innerHTML = `
          <h4>${index + 1}. ${company.name}</h4>
          <p>📍 ${company.location} | 🏢 ${company.industry} | 🏷️ ${company.size}</p>
          <button class="view-details" data-company-id="${company.id}">💼 View Details</button>
        `;
        companyList.appendChild(div);
      });
  
      document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', () => {
          const companyId = btn.getAttribute('data-company-id');
          console.log("Clicked company ID:", companyId);
        });
      });
  
    } catch (err) {
      console.error('Failed to load summary:', err);
    }
  });
  