namespace IAGenetic_DrawingMuse
{
    partial class Form1
    {
        /// <summary>
        /// Variable nécessaire au concepteur.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Nettoyage des ressources utilisées.
        /// </summary>
        /// <param name="disposing">true si les ressources managées doivent être supprimées ; sinon, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Code généré par le Concepteur Windows Form

        /// <summary>
        /// Méthode requise pour la prise en charge du concepteur - ne modifiez pas
        /// le contenu de cette méthode avec l'éditeur de code.
        /// </summary>
        private void InitializeComponent()
        {
            this.splitContainer1 = new System.Windows.Forms.SplitContainer();
            this.splitContainer2 = new System.Windows.Forms.SplitContainer();
            this.pictureBoxGoal = new System.Windows.Forms.PictureBox();
            this.splitContainer3 = new System.Windows.Forms.SplitContainer();
            this.buttonEvolve = new System.Windows.Forms.Button();
            this.buttonInitialization = new System.Windows.Forms.Button();
            this.pictureBoxGenetic = new System.Windows.Forms.PictureBox();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer1)).BeginInit();
            this.splitContainer1.Panel1.SuspendLayout();
            this.splitContainer1.Panel2.SuspendLayout();
            this.splitContainer1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer2)).BeginInit();
            this.splitContainer2.Panel2.SuspendLayout();
            this.splitContainer2.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxGoal)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer3)).BeginInit();
            this.splitContainer3.Panel1.SuspendLayout();
            this.splitContainer3.Panel2.SuspendLayout();
            this.splitContainer3.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxGenetic)).BeginInit();
            this.SuspendLayout();
            // 
            // splitContainer1
            // 
            this.splitContainer1.Dock = System.Windows.Forms.DockStyle.Fill;
            this.splitContainer1.Location = new System.Drawing.Point(0, 0);
            this.splitContainer1.Name = "splitContainer1";
            // 
            // splitContainer1.Panel1
            // 
            this.splitContainer1.Panel1.Controls.Add(this.splitContainer2);
            // 
            // splitContainer1.Panel2
            // 
            this.splitContainer1.Panel2.Controls.Add(this.splitContainer3);
            this.splitContainer1.Size = new System.Drawing.Size(613, 554);
            this.splitContainer1.SplitterDistance = 306;
            this.splitContainer1.TabIndex = 0;
            // 
            // splitContainer2
            // 
            this.splitContainer2.Dock = System.Windows.Forms.DockStyle.Fill;
            this.splitContainer2.Location = new System.Drawing.Point(0, 0);
            this.splitContainer2.Name = "splitContainer2";
            this.splitContainer2.Orientation = System.Windows.Forms.Orientation.Horizontal;
            // 
            // splitContainer2.Panel2
            // 
            this.splitContainer2.Panel2.Controls.Add(this.pictureBoxGoal);
            this.splitContainer2.Size = new System.Drawing.Size(306, 554);
            this.splitContainer2.SplitterDistance = 120;
            this.splitContainer2.TabIndex = 0;
            // 
            // pictureBoxGoal
            // 
            this.pictureBoxGoal.Dock = System.Windows.Forms.DockStyle.Fill;
            this.pictureBoxGoal.Location = new System.Drawing.Point(0, 0);
            this.pictureBoxGoal.Name = "pictureBoxGoal";
            this.pictureBoxGoal.Size = new System.Drawing.Size(306, 430);
            this.pictureBoxGoal.SizeMode = System.Windows.Forms.PictureBoxSizeMode.AutoSize;
            this.pictureBoxGoal.TabIndex = 0;
            this.pictureBoxGoal.TabStop = false;
            // 
            // splitContainer3
            // 
            this.splitContainer3.Dock = System.Windows.Forms.DockStyle.Fill;
            this.splitContainer3.Location = new System.Drawing.Point(0, 0);
            this.splitContainer3.Name = "splitContainer3";
            this.splitContainer3.Orientation = System.Windows.Forms.Orientation.Horizontal;
            // 
            // splitContainer3.Panel1
            // 
            this.splitContainer3.Panel1.Controls.Add(this.buttonEvolve);
            this.splitContainer3.Panel1.Controls.Add(this.buttonInitialization);
            // 
            // splitContainer3.Panel2
            // 
            this.splitContainer3.Panel2.Controls.Add(this.pictureBoxGenetic);
            this.splitContainer3.Size = new System.Drawing.Size(303, 554);
            this.splitContainer3.SplitterDistance = 120;
            this.splitContainer3.TabIndex = 0;
            // 
            // buttonEvolve
            // 
            this.buttonEvolve.Location = new System.Drawing.Point(216, 12);
            this.buttonEvolve.Name = "buttonEvolve";
            this.buttonEvolve.Size = new System.Drawing.Size(75, 23);
            this.buttonEvolve.TabIndex = 1;
            this.buttonEvolve.Text = "GO";
            this.buttonEvolve.UseVisualStyleBackColor = true;
            this.buttonEvolve.Click += new System.EventHandler(this.buttonEvolve_Click);
            // 
            // buttonInitialization
            // 
            this.buttonInitialization.Location = new System.Drawing.Point(23, 12);
            this.buttonInitialization.Name = "buttonInitialization";
            this.buttonInitialization.Size = new System.Drawing.Size(75, 23);
            this.buttonInitialization.TabIndex = 0;
            this.buttonInitialization.Text = "Initialization";
            this.buttonInitialization.UseVisualStyleBackColor = true;
            this.buttonInitialization.Click += new System.EventHandler(this.buttonInitialization_Click);
            // 
            // pictureBoxGenetic
            // 
            this.pictureBoxGenetic.Dock = System.Windows.Forms.DockStyle.Fill;
            this.pictureBoxGenetic.Location = new System.Drawing.Point(0, 0);
            this.pictureBoxGenetic.Name = "pictureBoxGenetic";
            this.pictureBoxGenetic.Size = new System.Drawing.Size(303, 430);
            this.pictureBoxGenetic.SizeMode = System.Windows.Forms.PictureBoxSizeMode.AutoSize;
            this.pictureBoxGenetic.TabIndex = 0;
            this.pictureBoxGenetic.TabStop = false;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(613, 554);
            this.Controls.Add(this.splitContainer1);
            this.Name = "Form1";
            this.Text = "Form1";
            this.splitContainer1.Panel1.ResumeLayout(false);
            this.splitContainer1.Panel2.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer1)).EndInit();
            this.splitContainer1.ResumeLayout(false);
            this.splitContainer2.Panel2.ResumeLayout(false);
            this.splitContainer2.Panel2.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer2)).EndInit();
            this.splitContainer2.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxGoal)).EndInit();
            this.splitContainer3.Panel1.ResumeLayout(false);
            this.splitContainer3.Panel2.ResumeLayout(false);
            this.splitContainer3.Panel2.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer3)).EndInit();
            this.splitContainer3.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxGenetic)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.SplitContainer splitContainer1;
        private System.Windows.Forms.SplitContainer splitContainer2;
        private System.Windows.Forms.SplitContainer splitContainer3;
        private System.Windows.Forms.PictureBox pictureBoxGoal;
        private System.Windows.Forms.PictureBox pictureBoxGenetic;
        private System.Windows.Forms.Button buttonEvolve;
        private System.Windows.Forms.Button buttonInitialization;


    }
}

