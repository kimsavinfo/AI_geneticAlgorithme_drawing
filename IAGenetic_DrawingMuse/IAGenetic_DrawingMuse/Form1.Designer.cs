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
            this.textBoxMutation = new System.Windows.Forms.TextBox();
            this.textBoxCrossover = new System.Windows.Forms.TextBox();
            this.textBoxAcceptedError = new System.Windows.Forms.TextBox();
            this.textBoxMaxGeneration = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.listPictures = new System.Windows.Forms.ListBox();
            this.buttonEvolve = new System.Windows.Forms.Button();
            this.buttonInitialization = new System.Windows.Forms.Button();
            this.splitContainer2 = new System.Windows.Forms.SplitContainer();
            this.splitContainer3 = new System.Windows.Forms.SplitContainer();
            this.pictureBoxGoal = new System.Windows.Forms.PictureBox();
            this.pictureBoxGenetic = new System.Windows.Forms.PictureBox();
            this.logs = new System.Windows.Forms.RichTextBox();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer1)).BeginInit();
            this.splitContainer1.Panel1.SuspendLayout();
            this.splitContainer1.Panel2.SuspendLayout();
            this.splitContainer1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer2)).BeginInit();
            this.splitContainer2.Panel1.SuspendLayout();
            this.splitContainer2.Panel2.SuspendLayout();
            this.splitContainer2.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer3)).BeginInit();
            this.splitContainer3.Panel1.SuspendLayout();
            this.splitContainer3.Panel2.SuspendLayout();
            this.splitContainer3.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxGoal)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxGenetic)).BeginInit();
            this.SuspendLayout();
            // 
            // splitContainer1
            // 
            this.splitContainer1.Dock = System.Windows.Forms.DockStyle.Fill;
            this.splitContainer1.Location = new System.Drawing.Point(0, 0);
            this.splitContainer1.Name = "splitContainer1";
            this.splitContainer1.Orientation = System.Windows.Forms.Orientation.Horizontal;
            // 
            // splitContainer1.Panel1
            // 
            this.splitContainer1.Panel1.Controls.Add(this.textBoxMutation);
            this.splitContainer1.Panel1.Controls.Add(this.textBoxCrossover);
            this.splitContainer1.Panel1.Controls.Add(this.textBoxAcceptedError);
            this.splitContainer1.Panel1.Controls.Add(this.textBoxMaxGeneration);
            this.splitContainer1.Panel1.Controls.Add(this.label4);
            this.splitContainer1.Panel1.Controls.Add(this.label3);
            this.splitContainer1.Panel1.Controls.Add(this.label2);
            this.splitContainer1.Panel1.Controls.Add(this.label1);
            this.splitContainer1.Panel1.Controls.Add(this.listPictures);
            this.splitContainer1.Panel1.Controls.Add(this.buttonEvolve);
            this.splitContainer1.Panel1.Controls.Add(this.buttonInitialization);
            // 
            // splitContainer1.Panel2
            // 
            this.splitContainer1.Panel2.Controls.Add(this.splitContainer2);
            this.splitContainer1.Size = new System.Drawing.Size(624, 609);
            this.splitContainer1.SplitterDistance = 105;
            this.splitContainer1.TabIndex = 0;
            // 
            // textBoxMutation
            // 
            this.textBoxMutation.Location = new System.Drawing.Point(431, 81);
            this.textBoxMutation.Name = "textBoxMutation";
            this.textBoxMutation.Size = new System.Drawing.Size(35, 20);
            this.textBoxMutation.TabIndex = 10;
            this.textBoxMutation.Text = "10";
            this.textBoxMutation.TextAlign = System.Windows.Forms.HorizontalAlignment.Right;
            this.textBoxMutation.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.textBoxMutation_KeyPress);
            // 
            // textBoxCrossover
            // 
            this.textBoxCrossover.Location = new System.Drawing.Point(431, 58);
            this.textBoxCrossover.Name = "textBoxCrossover";
            this.textBoxCrossover.Size = new System.Drawing.Size(35, 20);
            this.textBoxCrossover.TabIndex = 9;
            this.textBoxCrossover.Text = "95";
            this.textBoxCrossover.TextAlign = System.Windows.Forms.HorizontalAlignment.Right;
            this.textBoxCrossover.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.textBoxCrossover_KeyPress);
            // 
            // textBoxAcceptedError
            // 
            this.textBoxAcceptedError.Location = new System.Drawing.Point(431, 35);
            this.textBoxAcceptedError.Name = "textBoxAcceptedError";
            this.textBoxAcceptedError.Size = new System.Drawing.Size(35, 20);
            this.textBoxAcceptedError.TabIndex = 8;
            this.textBoxAcceptedError.Text = "0";
            this.textBoxAcceptedError.TextAlign = System.Windows.Forms.HorizontalAlignment.Right;
            this.textBoxAcceptedError.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.textBoxAcceptedError_KeyPress);
            // 
            // textBoxMaxGeneration
            // 
            this.textBoxMaxGeneration.Location = new System.Drawing.Point(431, 12);
            this.textBoxMaxGeneration.Name = "textBoxMaxGeneration";
            this.textBoxMaxGeneration.Size = new System.Drawing.Size(35, 20);
            this.textBoxMaxGeneration.TabIndex = 7;
            this.textBoxMaxGeneration.Text = "100";
            this.textBoxMaxGeneration.TextAlign = System.Windows.Forms.HorizontalAlignment.Right;
            this.textBoxMaxGeneration.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.textBoxMaxGeneration_KeyPress);
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(360, 84);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(65, 13);
            this.label4.TabIndex = 6;
            this.label4.Text = "Mutation (%)";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(354, 61);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(71, 13);
            this.label3.TabIndex = 5;
            this.label3.Text = "Crossover (%)";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(331, 38);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(94, 13);
            this.label2.TabIndex = 4;
            this.label2.Text = "Accepted error (%)";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(340, 17);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(85, 13);
            this.label1.TabIndex = 3;
            this.label1.Text = "Max generations";
            // 
            // listPictures
            // 
            this.listPictures.FormattingEnabled = true;
            this.listPictures.Items.AddRange(new object[] {
            "france",
            "mario-pixelise",
            "landscape",
            "joconde",
            "mario"});
            this.listPictures.Location = new System.Drawing.Point(12, 12);
            this.listPictures.Name = "listPictures";
            this.listPictures.Size = new System.Drawing.Size(303, 82);
            this.listPictures.TabIndex = 2;
            // 
            // buttonEvolve
            // 
            this.buttonEvolve.Enabled = false;
            this.buttonEvolve.Location = new System.Drawing.Point(537, 45);
            this.buttonEvolve.Name = "buttonEvolve";
            this.buttonEvolve.Size = new System.Drawing.Size(75, 23);
            this.buttonEvolve.TabIndex = 1;
            this.buttonEvolve.Text = "Evolve";
            this.buttonEvolve.UseVisualStyleBackColor = true;
            this.buttonEvolve.Click += new System.EventHandler(this.buttonEvolve_Click);
            // 
            // buttonInitialization
            // 
            this.buttonInitialization.Location = new System.Drawing.Point(537, 12);
            this.buttonInitialization.Name = "buttonInitialization";
            this.buttonInitialization.Size = new System.Drawing.Size(75, 23);
            this.buttonInitialization.TabIndex = 0;
            this.buttonInitialization.Text = "Initialization";
            this.buttonInitialization.UseVisualStyleBackColor = true;
            this.buttonInitialization.Click += new System.EventHandler(this.buttonInitialization_Click);
            // 
            // splitContainer2
            // 
            this.splitContainer2.Dock = System.Windows.Forms.DockStyle.Fill;
            this.splitContainer2.Location = new System.Drawing.Point(0, 0);
            this.splitContainer2.Name = "splitContainer2";
            this.splitContainer2.Orientation = System.Windows.Forms.Orientation.Horizontal;
            // 
            // splitContainer2.Panel1
            // 
            this.splitContainer2.Panel1.Controls.Add(this.splitContainer3);
            // 
            // splitContainer2.Panel2
            // 
            this.splitContainer2.Panel2.Controls.Add(this.logs);
            this.splitContainer2.Size = new System.Drawing.Size(624, 500);
            this.splitContainer2.SplitterDistance = 404;
            this.splitContainer2.TabIndex = 0;
            // 
            // splitContainer3
            // 
            this.splitContainer3.Dock = System.Windows.Forms.DockStyle.Fill;
            this.splitContainer3.Location = new System.Drawing.Point(0, 0);
            this.splitContainer3.Name = "splitContainer3";
            // 
            // splitContainer3.Panel1
            // 
            this.splitContainer3.Panel1.Controls.Add(this.pictureBoxGoal);
            // 
            // splitContainer3.Panel2
            // 
            this.splitContainer3.Panel2.Controls.Add(this.pictureBoxGenetic);
            this.splitContainer3.Size = new System.Drawing.Size(624, 404);
            this.splitContainer3.SplitterDistance = 315;
            this.splitContainer3.TabIndex = 0;
            // 
            // pictureBoxGoal
            // 
            this.pictureBoxGoal.Dock = System.Windows.Forms.DockStyle.Fill;
            this.pictureBoxGoal.Location = new System.Drawing.Point(0, 0);
            this.pictureBoxGoal.Name = "pictureBoxGoal";
            this.pictureBoxGoal.Size = new System.Drawing.Size(315, 404);
            this.pictureBoxGoal.SizeMode = System.Windows.Forms.PictureBoxSizeMode.AutoSize;
            this.pictureBoxGoal.TabIndex = 0;
            this.pictureBoxGoal.TabStop = false;
            // 
            // pictureBoxGenetic
            // 
            this.pictureBoxGenetic.Dock = System.Windows.Forms.DockStyle.Fill;
            this.pictureBoxGenetic.Location = new System.Drawing.Point(0, 0);
            this.pictureBoxGenetic.Name = "pictureBoxGenetic";
            this.pictureBoxGenetic.Size = new System.Drawing.Size(305, 404);
            this.pictureBoxGenetic.SizeMode = System.Windows.Forms.PictureBoxSizeMode.AutoSize;
            this.pictureBoxGenetic.TabIndex = 0;
            this.pictureBoxGenetic.TabStop = false;
            // 
            // logs
            // 
            this.logs.BackColor = System.Drawing.SystemColors.InfoText;
            this.logs.Dock = System.Windows.Forms.DockStyle.Fill;
            this.logs.ForeColor = System.Drawing.SystemColors.Info;
            this.logs.Location = new System.Drawing.Point(0, 0);
            this.logs.Name = "logs";
            this.logs.Size = new System.Drawing.Size(624, 92);
            this.logs.TabIndex = 0;
            this.logs.Text = "";
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(624, 609);
            this.Controls.Add(this.splitContainer1);
            this.Name = "Form1";
            this.Text = "Form1";
            this.splitContainer1.Panel1.ResumeLayout(false);
            this.splitContainer1.Panel1.PerformLayout();
            this.splitContainer1.Panel2.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer1)).EndInit();
            this.splitContainer1.ResumeLayout(false);
            this.splitContainer2.Panel1.ResumeLayout(false);
            this.splitContainer2.Panel2.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer2)).EndInit();
            this.splitContainer2.ResumeLayout(false);
            this.splitContainer3.Panel1.ResumeLayout(false);
            this.splitContainer3.Panel1.PerformLayout();
            this.splitContainer3.Panel2.ResumeLayout(false);
            this.splitContainer3.Panel2.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.splitContainer3)).EndInit();
            this.splitContainer3.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxGoal)).EndInit();
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
        private System.Windows.Forms.ListBox listPictures;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox textBoxMutation;
        private System.Windows.Forms.TextBox textBoxCrossover;
        private System.Windows.Forms.TextBox textBoxAcceptedError;
        private System.Windows.Forms.TextBox textBoxMaxGeneration;
        private System.Windows.Forms.RichTextBox logs;
    }
}

