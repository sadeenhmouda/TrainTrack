if (result.match_scenario === "fallback") {
  Swal.fire({
    title: '⚡ No Perfect Match Found',
    html: `
      <p style="margin: 0; color: #444; font-size: 15px;">
        Based on your selections, no strong position match was found.<br>
        You can improve your results by selecting more subjects or skills.
      </p>
    `,
    showCancelButton: true,
    reverseButtons: true,
    cancelButtonText: 'Skip, Maybe Later',
    confirmButtonText: '🚀 Yes, Improve My Selection',
    customClass: {
      popup: 'fallback-card',
      confirmButton: 'fallback-btn-confirm',
      cancelButton: 'fallback-btn-cancel'
    },
    background: '#fff',
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then((popupResult) => {
    if (popupResult.isConfirmed) {
      window.location.href = "/traintrack/fallback/improve";
    } else {
      localStorage.setItem("fallbackTriggered", "true");
      renderSummary(result); // ✅ Only render AFTER user responds
    }
  });
} else {
  renderSummary(result); // ✅ Normal render
}
